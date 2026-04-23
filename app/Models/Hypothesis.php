<?php

namespace App\Models;

use App\Models\ContentPost;
use App\Models\HypothesisTest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hypothesis extends Model
{
    public function sourceContentPost(): BelongsTo
    {
        return $this->belongsTo(ContentPost::class, 'source_content_post_id');
    }

    public function tests(): HasMany
    {
        return $this->hasMany(HypothesisTest::class);
    }
}
