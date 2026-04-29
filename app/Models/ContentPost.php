<?php

namespace App\Models;

use App\Models\Account;
use App\Models\ContentMetric;
use App\Models\Hypothesis;
use App\Models\RotationCycleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ContentPost extends Model
{
    protected static function booted(): void
    {
        static::created(function (ContentPost $post) {
            $post->metric()->create();
        });
    }

    public function rotationCycleItem(): BelongsTo
    {
        return $this->belongsTo(RotationCycleItem::class);
    }

    public function metric(): MorphOne
    {
        return $this->morphOne(ContentMetric::class, 'metricable');
    }

    public function hypotheses(): HasMany
    {
        return $this->hasMany(Hypothesis::class, 'source_content_post_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
