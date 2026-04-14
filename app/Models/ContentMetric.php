<?php

namespace App\Models;

use App\Models\RotationCycleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentMetric extends Model
{
    protected $appends = [
        'reach_to_profile_conversion_rate',
        'profile_to_follow_conversion_rate',
        'likes_engagement_rate',
        'saves_engagement_rate',
        'comments_engagement_rate',
        'shares_engagement_rate',
        'reposts_engagement_rate',
        'total_engagement_rate',
    ];

    // RELATIONSHIPS

    public function rotationCycleItem(): BelongsTo
    {
        return $this->belongsTo(RotationCycleItem::class, 'rotation_cycle_item_id');
    }

    // FORMULAES
    // These methods calculate conversion and engagement rates based on the stored metrics. They handle division by zero gracefully.

    protected function calculateRate($numerator, $denominator): float
    {
        $denominator = (float) $denominator;

        if ($denominator <= 0) {
            return 0.0;
        }

        return round(((float) $numerator / $denominator) * 100, 2);
    }

    public function getReachToProfileConversionRateAttribute(): float
    {
        return $this->calculateRate($this->profile_visits, $this->accounts_reached);
    }

    public function getProfileToFollowConversionRateAttribute(): float
    {
        return $this->calculateRate($this->follows, $this->profile_visits);
    }

    public function getLikesEngagementRateAttribute(): float
    {
        return $this->calculateRate($this->likes, $this->views);
    }

    public function getSavesEngagementRateAttribute(): float
    {
        return $this->calculateRate($this->saves, $this->views);
    }

    public function getCommentsEngagementRateAttribute(): float
    {
        return $this->calculateRate($this->comments, $this->views);
    }

    public function getSharesEngagementRateAttribute(): float
    {
        return $this->calculateRate($this->shares, $this->views);
    }

    public function getRepostsEngagementRateAttribute(): float
    {
        return $this->calculateRate($this->reposts, $this->views);
    }

    public function getTotalEngagementRateAttribute(): float
    {
        $totalEngagement =
            (int) $this->likes +
            (int) $this->comments +
            (int) $this->shares +
            (int) $this->saves +
            (int) $this->reposts;

        return $this->calculateRate($totalEngagement, $this->views);
    }

    // SCOPES
    // These scopes can be used to filter metrics that have the necessary data for conversion and engagement rate calculations

    public function scopeWithConversionData($query)
    {
        return $query
            ->whereNotNull('accounts_reached')
            ->whereNotNull('profile_visits')
            ->whereNotNull('follows');
    }

    public function scopeWithEngagementData($query)
    {
        return $query
            ->where('views', '>', 0);
    }
}
