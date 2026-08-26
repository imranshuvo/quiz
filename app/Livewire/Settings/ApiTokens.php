<?php

namespace App\Livewire\Settings;

use App\Services\Tenancy;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ApiTokens extends Component
{
    public string $tokenName = '';

    public bool $writeAccess = false;

    public ?string $plainTextToken = null;

    public function createToken(Tenancy $tenancy): void
    {
        $this->validate([
            'tokenName' => ['required', 'string', 'max:80'],
            'writeAccess' => ['boolean'],
        ]);

        $workspace = $tenancy->current();
        abort_unless($workspace, 404);

        $abilities = ['workspace:read', 'content:read'];
        if ($this->writeAccess) {
            abort_unless(auth()->user()->roleIn($workspace)?->canEditContent(), 403);
            $abilities[] = 'content:write';
        }

        $token = auth()->user()->createToken($this->tokenName, $abilities, now()->addYear());
        $this->plainTextToken = $token->plainTextToken;

        activity('workspace')
            ->causedBy(auth()->user())
            ->withProperties(['workspace_id' => $workspace->id, 'token_name' => $this->tokenName])
            ->log('api_token.created');

        $this->reset(['tokenName', 'writeAccess']);
    }

    public function revokeToken(int $tokenId, Tenancy $tenancy): void
    {
        $token = auth()->user()->tokens()->findOrFail($tokenId);
        $name = $token->name;
        $token->delete();

        activity('workspace')
            ->causedBy(auth()->user())
            ->withProperties(['workspace_id' => $tenancy->current()?->id, 'token_name' => $name])
            ->log('api_token.revoked');
    }

    public function dismissToken(): void
    {
        $this->plainTextToken = null;
    }

    public function render(): View
    {
        return view('livewire.settings.api-tokens', [
            'tokens' => auth()->user()->tokens()->latest()->get(),
            'canWrite' => auth()->user()->roleIn(app(Tenancy::class)->current())?->canEditContent() ?? false,
        ]);
    }
}
