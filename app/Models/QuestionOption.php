<?php

namespace App\Models;

use App\Models\Concerns\BelongsToWorkspace;
use App\Models\Concerns\LogsWorkspaceActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionOption extends Model
{
    use BelongsToWorkspace;
    use HasFactory;
    use LogsWorkspaceActivity;

    protected $fillable = [
        'workspace_id',
        'question_id',
        'label',
        'value',
        'is_correct',
        'score',
        'position',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'score' => 'decimal:2',
        'position' => 'integer',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
