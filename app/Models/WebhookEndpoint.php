<?php

namespace App\Models;

use App\Models\Concerns\BelongsToWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class WebhookEndpoint extends Model
{
    use BelongsToWorkspace;
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'questionnaire_id',
        'name',
        'url',
        'secret',
        'active',
        'last_delivered_at',
    ];

    protected $attributes = [
        'active' => true,
    ];

    protected $casts = [
        'active' => 'boolean',
        'last_delivered_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $e) {
            $e->secret ??= Str::random(48);
        });
    }

    public function questionnaire(): BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(WebhookDelivery::class);
    }

    /** Endpoints that fire for the given questionnaire (specific OR workspace-wide). */
    public function scopeForQuestionnaire($query, int $questionnaireId)
    {
        return $query->where('active', true)
            ->where(function ($q) use ($questionnaireId) {
                $q->whereNull('questionnaire_id')
                    ->orWhere('questionnaire_id', $questionnaireId);
            });
    }
}
