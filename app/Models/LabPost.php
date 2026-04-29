<?php

namespace App\Models;

use App\Models\Account;
use App\Models\ContentMetric;
use App\Models\HypothesisTest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class LabPost extends Model
{
    protected $casts = [
        'same_format' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::created(function (LabPost $post) {
            $post->metric()->create();
        });
    }

    public function hypothesisTest(): BelongsTo
    {
        return $this->belongsTo(HypothesisTest::class);
    }

    public function metric(): MorphOne
    {
        return $this->morphOne(ContentMetric::class, 'metricable');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}