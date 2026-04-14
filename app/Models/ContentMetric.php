<?php

namespace App\Models;

use App\Models\RotationCycleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentMetric extends Model
{

    protected $casts = [
        'post_date' => 'datetime',
        'creation_time_hours' => 'decimal:2'    
    ];

    protected $appends = [
        'conversion_rate_reach_profile_visits',
        'conversion_rate_profile_visits_follows',
        'engagement_rate_likes',
        'engagement_rate_saves',
        'engagement_rate_total'
    ];

    public function rotationCycleItem(): BelongsTo
    {
        return $this->belongsTo(RotationCycleItem::class, 'rotation_cycle_item_id');
    }

    public function getConversionRateReachProfileVisitsAttribute(): float
    {
        if (empty($this->accounts_reached) || empty($this->profile_visits)) {
            return 0;
        }

        return round(($this->profile_visits / $this->accounts_reached) * 100, 2);
    }

    public function getConversionRateProfileVisitsFollowsAttribute(): float
    {
        if (empty($this->profile_visits) || empty($this->follows)) {
            return 0;
        }

        return round(($this->follows / $this->profile_visits) * 100, 2);
    }

    public function getEngagementRateLikesAttribute(): float
    {
        if (empty($this->views) || empty($this->likes)) {
            return 0;
        }

        return round(($this->likes / $this->views) * 100, 2);
    }

    public function getEngagementRateSavesAttribute(): float
    {
        if (empty($this->views) || empty($this->saves)) {
            return 0;
        }

        return round(($this->saves / $this->views) * 100, 2);
    }

    public function getEngagementRateTotalAttribute(): float
    {
        if (empty($this->views)) {
            return 0;
        }

        $totalEngagement = (int) $this->likes
            + (int) $this->comments
            + (int) $this->shares
            + (int) $this->saves;

        return round(($totalEngagement / $this->views) * 100, 2);
    }
}
