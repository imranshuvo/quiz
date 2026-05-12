<?php

namespace App\Models\Concerns;

use App\Models\Scopes\WorkspaceScope;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Apply this trait to any tenant-owned model. It:
 *  - Adds a global scope that filters by the current workspace.
 *  - Auto-fills `workspace_id` on creation from the current workspace.
 *  - Exposes `workspace()` and `withoutWorkspaceScope()` query helpers.
 */
trait BelongsToWorkspace
{
    public static function bootBelongsToWorkspace(): void
    {
        static::addGlobalScope(new WorkspaceScope);

        static::creating(function ($model) {
            if (empty($model->workspace_id)) {
                $current = app(Tenancy::class)->current();
                if ($current) {
                    $model->workspace_id = $current->id;
                }
            }
        });
    }

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function scopeWithoutWorkspaceScope(Builder $query): Builder
    {
        return $query->withoutGlobalScope(WorkspaceScope::class);
    }
}
