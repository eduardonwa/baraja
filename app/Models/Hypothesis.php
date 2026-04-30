<?php

namespace App\Models;

use App\Models\ContentPost;
use App\Models\HypothesisTest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperHypothesis
 */
class Hypothesis extends Model
{
    use SoftDeletes;

    protected $casts = [
        'confidence_score' => 'integer',
        'positive_signals_count' => 'integer',
        'failed_tests_count' => 'integer',
    ];

    public const VARIABLE_LABELS = [
        'hook' => 'Hook',
        'topic' => 'Tema',
        'visual' => 'Visual',
        'format' => 'Formato',
        'caption' => 'Caption/descripción de publicación',
        'combination' => 'Combinación (hook + idea)',
        'distribution' => 'Distribución',
        'other' => 'Otro'
    ];

    // RELATIONSHIPS
    
    public function sourceContentPost(): BelongsTo
    {
        return $this->belongsTo(ContentPost::class, 'source_content_post_id');
    }

    public function tests(): HasMany
    {
        return $this->hasMany(HypothesisTest::class);
    }

    public function getVariableLabelAttribute(): string
    {
        return self::VARIABLE_LABELS[$this->variable] ?? $this->variable;
    }
}
