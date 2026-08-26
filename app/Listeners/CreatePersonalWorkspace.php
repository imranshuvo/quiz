<?php

namespace App\Listeners;

use App\Enums\WorkspaceRole;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

class CreatePersonalWorkspace
{
    public function handle(Registered $event): void
    {
        $user = $event->user;
        if (! $user instanceof User) {
            return;
        }

        // Skip if this user already belongs to one (e.g. they were created
        // by accepting an invitation flow that pre-attached them).
        if ($user->workspaces()->exists()) {
            return;
        }

        $name = Str::of($user->name ?: $user->email)
            ->before('@')
            ->title()
            ->append("'s Workspace")
            ->toString();

        $workspace = Workspace::create([
            'owner_id' => $user->id,
            'name' => $name,
            'personal' => true,
        ]);

        $workspace->attachMember($user, WorkspaceRole::Owner);

        $user->forceFill(['current_workspace_id' => $workspace->id])->saveQuietly();
    }
}
