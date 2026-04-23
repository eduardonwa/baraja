<?php

namespace App\Models;

use App\Models\ContentMetric;
use App\Models\RotationCycleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function metric(): HasOne
    {
        return $this->hasOne(ContentMetric::class);
    }
}
