<?php

namespace App\Models;

use App\Enums\WorkspaceRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkspaceUser extends Model
{
    protected $table = 'workspace_user';

    protected $fillable = [
        'workspace_id',
        'user_id',
        'role',
    ];

    protected $casts = [
        'role' => WorkspaceRole::class,
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
