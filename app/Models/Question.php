<?php

namespace App\Models;

use App\Enums\QuestionType;
use App\Models\Concerns\BelongsToWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use BelongsToWorkspace;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'workspace_id',
        'questionnaire_id',
        'type',
        'title',
        'helper',
        'required',
        'position',
        'meta',
        'branching',
    ];

    protected $casts = [
        'type' => QuestionType::class,
        'required' => 'boolean',
        'position' => 'integer',
        'meta' => 'array',
        'branching' => 'array',
    ];

    public function questionnaire(): BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class)->orderBy('position');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(ResponseAnswer::class);
    }

    public function maxScore(): float
    {
        if (! $this->type->isAutoGradable()) {
            return 0.0;
        }

        return (float) $this->options()
            ->where('is_correct', true)
            ->sum('score');
    }
}
