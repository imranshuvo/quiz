<?php

namespace App\Models;

use App\Enums\WorkspaceRole;
use App\Models\Concerns\LogsWorkspaceActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class WorkspaceInvitation extends Model
{
    use LogsWorkspaceActivity;

    protected $fillable = [
        'workspace_id',
        'invited_by',
        'email',
        'role',
        'token',
        'expires_at',
        'accepted_at',
    ];

    protected $casts = [
        'role' => WorkspaceRole::class,
        'expires_at' => 'datetime',
        'accepted_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $invitation) {
            $invitation->token ??= Str::random(48);
            $invitation->expires_at ??= now()->addDays(14);
        });
    }

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function inviter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function isAccepted(): bool
    {
        return $this->accepted_at !== null;
    }

    public function isPending(): bool
    {
        return ! $this->isAccepted() && ! $this->isExpired();
    }

    public function acceptUrl(): string
    {
        return route('workspace-invitations.show', $this->token);
    }
}
