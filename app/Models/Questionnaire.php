<?php

namespace App\Models;

use App\Enums\QuestionnaireKind;
use App\Enums\QuestionnaireStatus;
use App\Models\Concerns\BelongsToWorkspace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Questionnaire extends Model
{
    use BelongsToWorkspace;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'workspace_id',
        'creator_id',
        'kind',
        'status',
        'title',
        'description',
        'slug',
        'settings',
        'published_at',
    ];

    protected $casts = [
        'kind' => QuestionnaireKind::class,
        'status' => QuestionnaireStatus::class,
        'settings' => 'array',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $q) {
            $q->slug ??= static::uniqueSlug();
        });
    }

    public static function uniqueSlug(): string
    {
        do {
            $slug = Str::lower(Str::random(10));
        } while (static::withTrashed()->withoutWorkspaceScope()->where('slug', $slug)->exists());

        return $slug;
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('position');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function publish(): void
    {
        $this->forceFill([
            'status' => QuestionnaireStatus::Published,
            'published_at' => $this->published_at ?? now(),
        ])->save();
    }

    public function archive(): void
    {
        $this->forceFill(['status' => QuestionnaireStatus::Archived])->save();
    }

    public function scopeOfKind(Builder $q, QuestionnaireKind $kind): Builder
    {
        return $q->where('kind', $kind);
    }
}
