<?php

namespace App\Livewire\Workspace;

use App\Models\Workspace;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Switcher extends Component
{
    public function switch(int $workspaceId): void
    {
        $user = auth()->user();
        if (! $user) {
            return;
        }

        $workspace = Workspace::forUser($user)->find($workspaceId);
        if (! $workspace) {
            return;
        }

        $user->switchWorkspace($workspace);

        $this->redirect(route('dashboard'), navigate: false);
    }

    public function render(): View
    {
        $user = auth()->user();
        $workspaces = $user
            ? $user->workspaces()->orderBy('workspaces.name')->get()
            : collect();
        $current = $user?->currentWorkspace;

        return view('livewire.workspace.switcher', [
            'workspaces' => $workspaces,
            'current' => $current,
        ]);
    }
}
