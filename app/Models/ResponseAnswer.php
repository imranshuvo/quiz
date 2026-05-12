<?php

namespace App\Models;

use App\Models\Concerns\BelongsToWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseAnswer extends Model
{
    use BelongsToWorkspace;
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'response_id',
        'question_id',
        'value',
        'is_correct',
        'score',
        'answered_at',
    ];

    protected $casts = [
        'value' => 'array',
        'is_correct' => 'boolean',
        'score' => 'decimal:2',
        'answered_at' => 'datetime',
    ];

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
