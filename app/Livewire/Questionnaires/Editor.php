<?php

namespace App\Livewire\Questionnaires;

use App\Enums\QuestionType;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionOption;
use App\Services\AI\QuestionGenerator;
use App\Services\Billing\Limits;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Throwable;

#[Layout('components.layouts.app')]
class Editor extends Component
{
    public Questionnaire $questionnaire;

    public string $title = '';

    public string $description = '';

    public bool $adaptiveDifficulty = false;

    /* AI generate modal state */
    public bool $showAiGenerate = false;

    public string $aiTopic = '';

    public int $aiCount = 5;

    public bool $aiGenerating = false;

    public ?string $aiError = null;

    public function mount(Questionnaire $questionnaire): void
    {
        $this->authorizeAccess($questionnaire);
        $this->questionnaire = $questionnaire;
        $this->title = $questionnaire->title;
        $this->description = (string) $questionnaire->description;
        $this->adaptiveDifficulty = (bool) ($questionnaire->settings['adaptive_difficulty'] ?? false);
    }

    protected function authorizeAccess(Questionnaire $q): void
    {
        $current = app(Tenancy::class)->current();
        abort_unless($current && $q->workspace_id === $current->id, 404);
        abort_unless(auth()->user()->roleIn($current)?->canEditContent(), 403);
    }

    public function saveDetails(): void
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $this->questionnaire->forceFill([
            'title' => $this->title,
            'description' => $this->description ?: null,
        ])->save();
    }

    public function toggleAdaptiveDifficulty(bool $enabled): void
    {
        abort_unless($this->questionnaire->kind->isGraded(), 422);
        $this->adaptiveDifficulty = $enabled;
        $this->questionnaire->update([
            'settings' => [...($this->questionnaire->settings ?? []), 'adaptive_difficulty' => $enabled],
        ]);
    }

    public function publish(): void
    {
        if ($this->questionnaire->questions()->count() === 0) {
            $this->addError('publish', 'Add at least one question before publishing.');

            return;
        }
        $this->questionnaire->publish();
    }

    public function archive(): void
    {
        $this->questionnaire->archive();
    }

    public function openAiGenerate(): void
    {
        $this->reset(['aiTopic', 'aiCount', 'aiError', 'aiGenerating']);
        $this->aiCount = 5;
        $this->showAiGenerate = true;
    }

    public function generateWithAi(QuestionGenerator $generator, Limits $limits): void
    {
        $this->validate([
            'aiTopic' => ['required', 'string', 'min:3', 'max:2000'],
            'aiCount' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        if (! $limits->canMakeAiCall($this->questionnaire->workspace)) {
            $this->aiError = 'You\'ve hit your AI call limit for this month. Upgrade your plan or wait until next month.';

            return;
        }

        $this->aiGenerating = true;
        $this->aiError = null;

        try {
            $generator->generateForTopic(
                questionnaire: $this->questionnaire,
                topic: $this->aiTopic,
                count: $this->aiCount,
                userId: auth()->id(),
            );
        } catch (Throwable $e) {
            $this->aiError = 'AI generation failed: '.$e->getMessage();
            $this->aiGenerating = false;

            return;
        }

        $this->aiGenerating = false;
        $this->showAiGenerate = false;
        $this->reset(['aiTopic']);
    }

    public function addQuestion(string $type): void
    {
        $type = QuestionType::from($type);
        $position = ((int) $this->questionnaire->questions()->max('position')) + 1;

        Question::create([
            'questionnaire_id' => $this->questionnaire->id,
            'type' => $type,
            'title' => 'Untitled question',
            'position' => $position,
        ]);
    }

    public function updateQuestion(int $questionId, string $field, mixed $value): void
    {
        $this->validate([
            'value' => match ($field) {
                'title' => ['required', 'string', 'max:1000'],
                'helper' => ['nullable', 'string', 'max:1000'],
                'required' => ['boolean'],
                default => ['nullable'],
            },
        ], attributes: ['value' => $field], data: ['value' => $value]);

        $allowed = ['title', 'helper', 'required'];
        abort_unless(in_array($field, $allowed, true), 422);

        Question::findOrFail($questionId)->update([$field => $value]);
    }

    public function updateQuestionDifficulty(int $questionId, int $difficulty): void
    {
        abort_unless($difficulty >= 1 && $difficulty <= 5, 422);
        $question = Question::findOrFail($questionId);
        $question->update(['meta' => [...($question->meta ?? []), 'difficulty' => $difficulty]]);
    }

    public function deleteQuestion(int $questionId): void
    {
        Question::findOrFail($questionId)->delete();
    }

    public function addOption(int $questionId): void
    {
        $question = Question::find($questionId);
        if (! $question || ! $question->type->hasOptions()) {
            return;
        }
        $position = ((int) $question->options()->max('position')) + 1;

        QuestionOption::create([
            'question_id' => $question->id,
            'label' => 'New option',
            'value' => 'option-'.$position,
            'position' => $position,
        ]);
    }

    public function updateOption(int $optionId, string $field, mixed $value): void
    {
        $allowed = ['label', 'value', 'is_correct', 'score'];
        abort_unless(in_array($field, $allowed, true), 422);

        QuestionOption::findOrFail($optionId)->update([$field => $value]);
    }

    public function deleteOption(int $optionId): void
    {
        QuestionOption::findOrFail($optionId)->delete();
    }

    public function render(): View
    {
        $questions = $this->questionnaire
            ->questions()
            ->with('options')
            ->get();

        return view('livewire.questionnaires.editor', [
            'questions' => $questions,
            'questionTypes' => QuestionType::cases(),
        ]);
    }
}
