<?php

namespace App\Models;

use App\Enums\WorkspaceRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'current_workspace_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function workspaces(): BelongsToMany
    {
        return $this->belongsToMany(Workspace::class, 'workspace_user')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function ownedWorkspaces(): HasMany
    {
        return $this->hasMany(Workspace::class, 'owner_id');
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(WorkspaceUser::class);
    }

    public function currentWorkspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class, 'current_workspace_id');
    }

    public function personalWorkspace(): ?Workspace
    {
        return $this->ownedWorkspaces()->where('personal', true)->first();
    }

    public function switchWorkspace(Workspace $workspace): void
    {
        if (! $workspace->hasMember($this)) {
            return;
        }
        $this->forceFill(['current_workspace_id' => $workspace->id])->save();
    }

    public function roleIn(Workspace $workspace): ?WorkspaceRole
    {
        return $workspace->roleFor($this);
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    // Filament: gate the /admin panel to internal staff. For now any
    // authenticated user can enter; tighten with a real staff flag in Phase 8.
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
