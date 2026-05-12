<?php

namespace App\Livewire\Questionnaires;

use App\Enums\QuestionnaireStatus;
use App\Enums\QuestionType;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Questionnaire;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Editor extends Component
{
    public Questionnaire $questionnaire;

    public string $title = '';

    public string $description = '';

    public function mount(Questionnaire $questionnaire): void
    {
        $this->authorizeAccess($questionnaire);
        $this->questionnaire = $questionnaire;
        $this->title = $questionnaire->title;
        $this->description = (string) $questionnaire->description;
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

        Question::where('id', $questionId)->update([$field => $value]);
    }

    public function deleteQuestion(int $questionId): void
    {
        Question::where('id', $questionId)->delete();
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

        QuestionOption::where('id', $optionId)->update([$field => $value]);
    }

    public function deleteOption(int $optionId): void
    {
        QuestionOption::where('id', $optionId)->delete();
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
