<?php

use App\Enums\QuestionnaireKind;
use App\Enums\QuestionnaireStatus;
use App\Enums\QuestionType;
use App\Enums\ResponseStatus;
use App\Events\PollVoteRecorded;
use App\Jobs\GradeResponse;
use App\Livewire\Public\Taker;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
});

function publishedAssessment(Workspace $workspace): Questionnaire
{
    $q = Questionnaire::factory()->published()->create([
        'workspace_id' => $workspace->id,
        'kind' => QuestionnaireKind::Assessment,
    ]);
    $q1 = Question::factory()->forQuestionnaire($q)->create(['position' => 1, 'required' => true]);
    QuestionOption::factory()->forQuestion($q1)->correct(2)->create(['value' => 'a']);
    QuestionOption::factory()->forQuestion($q1)->create(['value' => 'b']);
    $q2 = Question::factory()->shortText()->forQuestionnaire($q)->create(['position' => 2, 'required' => false]);

    return $q;
}

it('public taker route returns 200 for a published questionnaire', function () {
    $q = publishedAssessment($this->workspace);

    $this->get(route('public.taker', $q->slug))->assertOk();
});

it('public taker route 404s when the questionnaire is draft', function () {
    $q = Questionnaire::factory()->create([
        'workspace_id' => $this->workspace->id,
        'status' => QuestionnaireStatus::Draft,
    ]);

    $this->get(route('public.taker', $q->slug))->assertNotFound();
});

it('public taker route 404s for an unknown slug', function () {
    $this->get(route('public.taker', 'no-such-slug'))->assertNotFound();
});

it('mounts and creates an in-progress Response for an anonymous taker', function () {
    $q = publishedAssessment($this->workspace);

    $component = Livewire::test(Taker::class, ['slug' => $q->slug]);

    expect(Response::withoutWorkspaceScope()->count())->toBe(1);
    $r = Response::withoutWorkspaceScope()->first();
    expect($r->status)->toBe(ResponseStatus::InProgress);
    expect($r->respondent_user_id)->toBeNull();
    expect($r->session_token)->not->toBeEmpty();

    $component->assertSet('responseId', $r->id);
});

it('reuses an existing in-progress Response for the same auth user', function () {
    $q = publishedAssessment($this->workspace);
    $user = User::factory()->create();

    Livewire::actingAs($user)->test(Taker::class, ['slug' => $q->slug]);
    Livewire::actingAs($user)->test(Taker::class, ['slug' => $q->slug]);

    expect(Response::withoutWorkspaceScope()->count())->toBe(1);
});

it('selectChoice persists an answer to the response', function () {
    $q = publishedAssessment($this->workspace);
    $first = $q->questions()->orderBy('position')->first();

    $component = Livewire::test(Taker::class, ['slug' => $q->slug])
        ->call('selectChoice', $first->id, 'a');

    $answer = ResponseAnswer::withoutWorkspaceScope()->first();
    expect($answer)->not->toBeNull();
    expect($answer->value)->toBe(['a']);
});

it('next() blocks advancing if a required question is unanswered', function () {
    $q = publishedAssessment($this->workspace);

    Livewire::test(Taker::class, ['slug' => $q->slug])
        ->call('next')
        ->assertHasErrors(['answer']);
});

it('next() advances after an answer is recorded', function () {
    $q = publishedAssessment($this->workspace);
    $first = $q->questions()->orderBy('position')->first();
    $second = $q->questions()->orderBy('position')->skip(1)->first();

    $component = Livewire::test(Taker::class, ['slug' => $q->slug])
        ->call('selectChoice', $first->id, 'a')
        ->call('next');

    $component->assertSet('currentQuestionId', $second->id);
});

it('submit() finalizes the response and computes score for assessments', function () {
    Bus::fake([GradeResponse::class]); // async AI grading isn't tested here.
    $q = publishedAssessment($this->workspace);
    $first = $q->questions()->orderBy('position')->first();
    $second = $q->questions()->orderBy('position')->skip(1)->first();

    Livewire::test(Taker::class, ['slug' => $q->slug])
        ->call('selectChoice', $first->id, 'a')
        ->call('next')                          // → second question
        ->call('setScalar', $second->id, 'free response')
        ->call('next');                         // → submit

    $r = Response::withoutWorkspaceScope()->first();
    expect($r->status)->toBe(ResponseStatus::Submitted);
    expect((float) $r->score)->toBe(2.0);
    expect((float) $r->max_score)->toBe(2.0);
    Bus::assertDispatched(GradeResponse::class);
});

it('public result route returns 200 for a submitted response', function () {
    Bus::fake([GradeResponse::class]);
    $q = publishedAssessment($this->workspace);
    $first = $q->questions()->orderBy('position')->first();
    $second = $q->questions()->orderBy('position')->skip(1)->first();

    $component = Livewire::test(Taker::class, ['slug' => $q->slug])
        ->call('selectChoice', $first->id, 'a')
        ->call('next')
        ->call('setScalar', $second->id, 'free')
        ->call('next');

    $r = Response::withoutWorkspaceScope()->first();

    $redirect = $component->effects['redirect'] ?? null;
    $this->get($redirect)->assertOk();
});

it('stores file answers on the private disk', function () {
    Storage::fake('local');
    $q = Questionnaire::factory()->form()->published()->create(['workspace_id' => $this->workspace->id]);
    $question = Question::factory()->forQuestionnaire($q)->create([
        'type' => QuestionType::File,
        'required' => true,
        'position' => 1,
    ]);

    Livewire::test(Taker::class, ['slug' => $q->slug])
        ->set("uploads.{$question->id}", UploadedFile::fake()->create('evidence.pdf', 100, 'application/pdf'))
        ->call('saveUpload', $question->id)
        ->assertHasNoErrors();

    $answer = ResponseAnswer::withoutWorkspaceScope()->first();
    expect($answer->value[0]['name'])->toBe('evidence.pdf');
    Storage::disk('local')->assertExists($answer->value[0]['path']);
});

it('result route 404s if response is not submitted', function () {
    $q = publishedAssessment($this->workspace);
    Livewire::test(Taker::class, ['slug' => $q->slug]);
    $r = Response::withoutWorkspaceScope()->first();

    $this->get(route('public.result', ['slug' => $q->slug, 'response' => $r->id]))->assertNotFound();
});

it('persistAnswer broadcasts PollVoteRecorded for poll questionnaires', function () {
    Event::fake([PollVoteRecorded::class]);

    $poll = Questionnaire::factory()->poll()->published()->create([
        'workspace_id' => $this->workspace->id,
    ]);
    $question = Question::factory()->forQuestionnaire($poll)->create(['position' => 1]);
    QuestionOption::factory()->forQuestion($question)->create(['value' => 'a']);

    Livewire::test(Taker::class, ['slug' => $poll->slug])
        ->call('selectChoice', $question->id, 'a');

    Event::assertDispatched(PollVoteRecorded::class, fn ($e) => $e->questionId === $question->id);
});

it('persistAnswer does NOT broadcast PollVoteRecorded for non-poll questionnaires', function () {
    Event::fake([PollVoteRecorded::class]);

    $assessment = publishedAssessment($this->workspace);
    $first = $assessment->questions()->orderBy('position')->first();

    Livewire::test(Taker::class, ['slug' => $assessment->slug])
        ->call('selectChoice', $first->id, 'a');

    Event::assertNotDispatched(PollVoteRecorded::class);
});
