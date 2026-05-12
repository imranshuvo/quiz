<?php

namespace App\Models;

use App\Enums\WorkspaceRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;

class Workspace extends Model
{
    use Billable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'personal',
    ];

    protected $casts = [
        'personal' => 'boolean',
        'trial_ends_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $workspace) {
            if (empty($workspace->slug)) {
                $workspace->slug = static::uniqueSlugFor($workspace->name);
            }
        });
    }

    public static function uniqueSlugFor(string $name): string
    {
        $base = Str::slug($name) ?: 'workspace';
        $slug = $base;
        $i = 1;
        while (static::withTrashed()->where('slug', $slug)->exists()) {
            $slug = $base.'-'.++$i;
        }
        return $slug;
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'workspace_user')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(WorkspaceUser::class);
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(WorkspaceInvitation::class);
    }

    public function hasMember(User $user): bool
    {
        return $this->members()->where('users.id', $user->id)->exists();
    }

    public function roleFor(User $user): ?WorkspaceRole
    {
        $membership = $this->memberships()->where('user_id', $user->id)->first();
        // `$membership->role` is already cast to WorkspaceRole on WorkspaceUser.
        return $membership?->role;
    }

    public function attachMember(User $user, WorkspaceRole $role): WorkspaceUser
    {
        return $this->memberships()->updateOrCreate(
            ['user_id' => $user->id],
            ['role' => $role->value],
        );
    }

    public function scopeForUser(Builder $query, User $user): Builder
    {
        return $query->whereHas('memberships', fn ($q) => $q->where('user_id', $user->id));
    }
}
