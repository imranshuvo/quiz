<?php

namespace App\Services;

use App\Models\User;
use App\Models\Workspace;

/**
 * Resolves and tracks the "current workspace" for a request, console command,
 * or job. Bound as a singleton in AppServiceProvider so global scopes can ask
 * the same instance via `app(Tenancy::class)`.
 */
class Tenancy
{
    protected ?Workspace $current = null;

    public function current(): ?Workspace
    {
        return $this->current;
    }

    public function setCurrent(?Workspace $workspace): self
    {
        $this->current = $workspace;
        return $this;
    }

    /**
     * Resolve the workspace for an authenticated user — preferring their
     * `current_workspace_id` if it points at one they still belong to,
     * otherwise the first workspace they're a member of.
     */
    public function resolveFor(User $user): ?Workspace
    {
        $current = $user->currentWorkspace;
        if ($current && $current->hasMember($user)) {
            return $current;
        }

        $first = $user->workspaces()->orderBy('workspaces.created_at')->first();
        if ($first && (int) $user->current_workspace_id !== $first->id) {
            $user->forceFill(['current_workspace_id' => $first->id])->saveQuietly();
        }
        return $first;
    }

    /** Run the callback with a different workspace temporarily set. */
    public function runAs(?Workspace $workspace, callable $callback): mixed
    {
        $previous = $this->current;
        $this->current = $workspace;
        try {
            return $callback();
        } finally {
            $this->current = $previous;
        }
    }
}
