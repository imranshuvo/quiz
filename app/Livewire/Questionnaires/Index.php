<?php

namespace App\Livewire\Questionnaires;

use App\Enums\QuestionnaireKind;
use App\Models\Questionnaire;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public bool $showCreate = false;

    public string $newTitle = '';

    public string $newKind = QuestionnaireKind::Assessment->value;

    public function rules(): array
    {
        return [
            'newTitle' => ['required', 'string', 'max:255'],
            'newKind' => ['required', Rule::in(array_map(fn ($k) => $k->value, QuestionnaireKind::cases()))],
        ];
    }

    public function openCreate(): void
    {
        $this->reset(['newTitle', 'newKind']);
        $this->newKind = QuestionnaireKind::Assessment->value;
        $this->showCreate = true;
    }

    public function create(Tenancy $tenancy): void
    {
        $workspace = $tenancy->current();
        abort_unless($workspace, 404);
        abort_unless(auth()->user()->roleIn($workspace)?->canEditContent(), 403);

        $this->validate();

        $q = Questionnaire::create([
            'creator_id' => auth()->id(),
            'kind' => $this->newKind,
            'title' => $this->newTitle,
        ]);

        $this->showCreate = false;
        $this->redirectRoute('questionnaires.edit', $q, navigate: true);
    }

    public function delete(int $id, Tenancy $tenancy): void
    {
        $workspace = $tenancy->current();
        abort_unless($workspace, 404);
        abort_unless(auth()->user()->roleIn($workspace)?->canEditContent(), 403);

        $q = Questionnaire::find($id);
        $q?->delete();
    }

    public function render(): View
    {
        $questionnaires = Questionnaire::query()
            ->with('creator')
            ->withCount('questions')
            ->latest()
            ->get();

        return view('livewire.questionnaires.index', [
            'questionnaires' => $questionnaires,
            'kinds' => QuestionnaireKind::cases(),
        ]);
    }
}
