<?php

namespace App\Models\Scopes;

use App\Services\Tenancy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class WorkspaceScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $workspace = app(Tenancy::class)->current();

        if ($workspace === null) {
            // No current workspace → return zero rows. This protects against
            // accidental cross-tenant reads in jobs/console contexts that
            // forget to set a workspace. Use `withoutWorkspaceScope()` to opt
            // out explicitly.
            $builder->whereRaw('1 = 0');

            return;
        }

        $builder->where(
            $model->qualifyColumn('workspace_id'),
            $workspace->id,
        );
    }
}
