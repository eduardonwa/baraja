<?php

namespace App\Models;

use App\Models\Hypothesis;
use App\Models\LabPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperHypothesisTest
 */
class HypothesisTest extends Model
{
    public function hypothesis(): BelongsTo
    {
        return $this->belongsTo(Hypothesis::class);
    }

    public function labPost(): HasOne
    {
        return $this->hasOne(LabPost::class);
    }
}
