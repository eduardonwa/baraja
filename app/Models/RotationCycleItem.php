<?php

namespace App\Models;

use App\Models\ContentMetric;
use App\Models\Idea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Mail\Mailables\Content;

class RotationCycleItem extends Model
{
    use HasFactory;

    protected $casts = [
        'done' => 'boolean',
        'completed_at' => 'datetime'
    ];

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(RotationCycle::class, 'rotation_cycle_id');
    }

    public function hook(): BelongsTo
    {
        return $this->belongsTo(Hook::class, 'hook_id');
    }

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class, 'idea_id');
    }

    public function metric(): HasOne
    {
        return $this->hasOne(ContentMetric::class);
    }    
}
