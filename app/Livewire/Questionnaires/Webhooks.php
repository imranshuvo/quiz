<?php

namespace App\Livewire\Questionnaires;

use App\Models\Questionnaire;
use App\Models\WebhookEndpoint;
use App\Services\Billing\Limits;
use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Webhooks extends Component
{
    public Questionnaire $questionnaire;

    public bool $showCreate = false;

    public string $newName = '';

    public string $newUrl = '';

    public function mount(Questionnaire $questionnaire): void
    {
        $current = app(Tenancy::class)->current();
        abort_unless($current && $questionnaire->workspace_id === $current->id, 404);
        $this->questionnaire = $questionnaire;
    }

    protected function authorizeManage(): void
    {
        $w = app(Tenancy::class)->current();
        abort_unless(auth()->user()->roleIn($w)?->canManageMembers() || auth()->user()->roleIn($w)?->canEditContent(), 403);
    }

    public function openCreate(): void
    {
        $this->reset(['newName', 'newUrl']);
        $this->showCreate = true;
    }

    public function create(Limits $limits): void
    {
        $this->authorizeManage();
        $this->validate([
            'newName' => ['required', 'string', 'max:120'],
            'newUrl' => ['required', 'url', 'max:500'],
        ]);

        if (! $limits->canAddWebhook(app(Tenancy::class)->current())) {
            $this->addError('newUrl', 'Your plan doesn\'t allow webhooks (or you\'ve hit the limit). Upgrade to add more.');
            return;
        }

        WebhookEndpoint::create([
            'questionnaire_id' => $this->questionnaire->id,
            'name' => $this->newName,
            'url' => $this->newUrl,
        ]);

        $this->showCreate = false;
        $this->reset(['newName', 'newUrl']);
    }

    public function toggle(int $id): void
    {
        $this->authorizeManage();
        $endpoint = WebhookEndpoint::where('questionnaire_id', $this->questionnaire->id)->find($id);
        if (! $endpoint) {
            return;
        }
        $endpoint->forceFill(['active' => ! $endpoint->active])->save();
    }

    public function delete(int $id): void
    {
        $this->authorizeManage();
        WebhookEndpoint::where('questionnaire_id', $this->questionnaire->id)->where('id', $id)->delete();
    }

    public function render(): View
    {
        $endpoints = WebhookEndpoint::where('questionnaire_id', $this->questionnaire->id)
            ->withCount(['deliveries', 'deliveries as success_count' => function ($q) {
                $q->where('status', 'success');
            }])
            ->latest()
            ->get();

        return view('livewire.questionnaires.webhooks', compact('endpoints'));
    }
}
