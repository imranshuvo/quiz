<?php

namespace App\Models;

use App\Enums\ResponseStatus;
use App\Models\Concerns\BelongsToWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Response extends Model
{
    use BelongsToWorkspace;
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'questionnaire_id',
        'respondent_user_id',
        'respondent_email',
        'session_token',
        'status',
        'score',
        'max_score',
        'started_at',
        'submitted_at',
        'meta',
    ];

    protected $casts = [
        'status' => ResponseStatus::class,
        'score' => 'decimal:2',
        'max_score' => 'decimal:2',
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
        'meta' => 'array',
    ];

    public function questionnaire(): BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function respondent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'respondent_user_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(ResponseAnswer::class);
    }

    public function isAnonymous(): bool
    {
        return $this->respondent_user_id === null;
    }

    public function percentage(): ?float
    {
        if ($this->max_score === null || (float) $this->max_score == 0.0) {
            return null;
        }

        return round(((float) $this->score / (float) $this->max_score) * 100, 2);
    }
}
