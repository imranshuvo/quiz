<?php

namespace App\Models;

use App\Enums\AiUsageKind;
use App\Models\Concerns\BelongsToWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiUsage extends Model
{
    use BelongsToWorkspace;
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'user_id',
        'kind',
        'provider',
        'model',
        'prompt_tokens',
        'completion_tokens',
        'cost_cents',
        'meta',
    ];

    protected $casts = [
        'kind' => AiUsageKind::class,
        'prompt_tokens' => 'integer',
        'completion_tokens' => 'integer',
        'cost_cents' => 'integer',
        'meta' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
