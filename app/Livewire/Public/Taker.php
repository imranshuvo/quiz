<?php

namespace App\Livewire\Public;

use App\Enums\QuestionnaireKind;
use App\Enums\QuestionnaireStatus;
use App\Enums\QuestionType;
use App\Enums\ResponseStatus;
use App\Events\PollVoteRecorded;
use App\Jobs\GradeResponse;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\Workspace;
use App\Services\Branching;
use App\Services\Scoring;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.public')]
class Taker extends Component
{
    public string $slug = '';

    public int $workspaceId = 0;

    public int $questionnaireId = 0;

    public int $responseId = 0;

    public ?int $currentQuestionId = null;

    /** @var array<int, mixed>  question_id => current answer value */
    public array $answers = [];

    public bool $submitted = false;

    public function mount(string $slug): void
    {
        $this->slug = $slug;

        // Public access — bypass the workspace scope just to find the
        // questionnaire, then set the tenancy to its workspace for all
        // subsequent operations on this request.
        $q = Questionnaire::withoutWorkspaceScope()
            ->where('slug', $slug)
            ->firstOrFail();

        abort_unless($q->status === QuestionnaireStatus::Published, 404);

        $this->bootTenancy($q->workspace_id);
        $this->questionnaireId = $q->id;
        $this->workspaceId = $q->workspace_id;

        $response = $this->findOrCreateResponse($q);
        $this->responseId = $response->id;
        $this->submitted = $response->status === ResponseStatus::Submitted;

        // Hydrate any existing answers (e.g. resumed session).
        $this->answers = $response->answers()->pluck('value', 'question_id')->all();

        // Start at the first question by position, unless we already have a
        // partial response in flight (then continue from the first unanswered).
        $this->currentQuestionId = $this->firstUnansweredQuestionId($q) ?? $q->questions()->orderBy('position')->value('id');
    }

    /** Livewire 3 hydration hook — re-establish tenancy on every request. */
    public function hydrate(): void
    {
        if ($this->workspaceId > 0) {
            $this->bootTenancy($this->workspaceId);
        }
    }

    public function selectChoice(int $questionId, string $value): void
    {
        $this->answers[$questionId] = [$value];
        $this->persistAnswer($questionId);
    }

    public function toggleChoice(int $questionId, string $value): void
    {
        $current = $this->answers[$questionId] ?? [];
        if (! is_array($current)) {
            $current = [$current];
        }
        $current = in_array($value, $current, true)
            ? array_values(array_filter($current, fn ($v) => $v !== $value))
            : [...$current, $value];

        $this->answers[$questionId] = $current;
        $this->persistAnswer($questionId);
    }

    public function setScalar(int $questionId, mixed $value): void
    {
        $this->answers[$questionId] = is_array($value) ? $value : [$value];
        $this->persistAnswer($questionId);
    }

    protected function persistAnswer(int $questionId): void
    {
        ResponseAnswer::updateOrCreate(
            ['response_id' => $this->responseId, 'question_id' => $questionId],
            [
                'workspace_id' => $this->workspaceId,
                'value' => $this->answers[$questionId] ?? null,
                'answered_at' => now(),
            ],
        );

        // Live polls broadcast on every recorded vote so audiences see the
        // bars move. Only fire when this is a poll AND the answer is final.
        $q = $this->questionnaire();
        if ($q->kind === QuestionnaireKind::Poll) {
            event(new PollVoteRecorded($q, $questionId));
        }
    }

    public function next(Branching $branching): void
    {
        if (! $this->currentQuestionId) {
            return;
        }

        $current = Question::find($this->currentQuestionId);
        if (! $current) {
            return;
        }

        // Hard-stop if a required question has no answer.
        $val = $this->answers[$current->id] ?? null;
        if ($current->required && ! $this->hasNonEmptyAnswer($val)) {
            $this->addError('answer', 'This question is required.');
            return;
        }

        $next = $branching->nextQuestionId($current, $val, $this->response());
        if ($next === null) {
            $this->submit(app(Scoring::class));
            return;
        }
        $this->currentQuestionId = $next;
    }

    public function previous(): void
    {
        $q = $this->questionnaire();
        $current = Question::find($this->currentQuestionId);
        if (! $current) {
            return;
        }
        $prev = $q->questions()
            ->where('position', '<', $current->position)
            ->orderByDesc('position')
            ->first();
        if ($prev) {
            $this->currentQuestionId = $prev->id;
        }
    }

    public function submit(Scoring $scoring): void
    {
        $response = $this->response();
        $response->forceFill([
            'status' => ResponseStatus::Submitted,
            'submitted_at' => now(),
        ])->save();

        $scoring->scoreResponse($response->refresh());

        // Async AI grading of any open-ended answers — bumps Response.score
        // when it lands. The result page reads whatever score is current at
        // view time, so the user may see a slightly higher score on refresh.
        if ($response->questionnaire->kind->isGraded()) {
            GradeResponse::dispatch($response->id, $this->workspaceId);
        }

        $this->redirect(route('public.result', [
            'slug' => $this->slug,
            'response' => $response->id,
        ]), navigate: false);
    }

    protected function questionnaire(): Questionnaire
    {
        return Questionnaire::withoutWorkspaceScope()->findOrFail($this->questionnaireId);
    }

    protected function response(): Response
    {
        return Response::withoutWorkspaceScope()->findOrFail($this->responseId);
    }

    protected function bootTenancy(int $workspaceId): void
    {
        $workspace = Workspace::find($workspaceId);
        if ($workspace) {
            app(Tenancy::class)->setCurrent($workspace);
        }
    }

    protected function findOrCreateResponse(Questionnaire $q): Response
    {
        $user = auth()->user();
        $token = $this->resolveSessionToken();

        $existing = Response::query()
            ->where('questionnaire_id', $q->id)
            ->when($user, fn ($qq) => $qq->where('respondent_user_id', $user->id))
            ->when(! $user, fn ($qq) => $qq->where('session_token', $token))
            ->where('status', ResponseStatus::InProgress)
            ->latest()
            ->first();

        if ($existing) {
            return $existing;
        }

        return Response::create([
            'questionnaire_id' => $q->id,
            'respondent_user_id' => $user?->id,
            'respondent_email' => $user?->email,
            'session_token' => $token,
            'status' => ResponseStatus::InProgress,
            'started_at' => now(),
            'meta' => [
                'user_agent' => substr((string) request()->userAgent(), 0, 255),
            ],
        ]);
    }

    protected function resolveSessionToken(): string
    {
        $cookieName = 'qz_'.substr(md5($this->slug), 0, 12);
        $token = Cookie::get($cookieName) ?: Str::random(48);
        Cookie::queue($cookieName, $token, minutes: 60 * 24 * 30);
        return $token;
    }

    protected function firstUnansweredQuestionId(Questionnaire $q): ?int
    {
        $answered = array_keys($this->answers);
        $next = $q->questions()
            ->when(! empty($answered), fn ($qq) => $qq->whereNotIn('id', $answered))
            ->orderBy('position')
            ->value('id');

        return $next;
    }

    protected function hasNonEmptyAnswer(mixed $value): bool
    {
        if ($value === null || $value === '') {
            return false;
        }
        if (is_array($value)) {
            return count(array_filter($value, fn ($v) => $v !== null && $v !== '')) > 0;
        }
        return true;
    }

    public function render(): View
    {
        $q = $this->questionnaire();
        $questions = $q->questions()->with('options')->get();
        $current = $this->currentQuestionId
            ? $questions->firstWhere('id', $this->currentQuestionId)
            : null;

        $answeredCount = collect($this->answers)
            ->filter(fn ($v) => $this->hasNonEmptyAnswer($v))
            ->count();

        $progress = $questions->count() > 0
            ? (int) round(min(100, ($answeredCount / $questions->count()) * 100))
            : 0;

        $position = $current
            ? $questions->search(fn ($qq) => $qq->id === $current->id) + 1
            : 0;

        return view('livewire.public.taker', [
            'questionnaire' => $q,
            'questions' => $questions,
            'current' => $current,
            'progress' => $progress,
            'position' => $position,
            'total' => $questions->count(),
        ]);
    }
}
