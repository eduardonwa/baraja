<?php

namespace App\Models;

use App\Models\ContentPost;
use App\Models\Idea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\ValidationException;

class RotationCycleItem extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::saving(function ($item) {
            if ($item->idea_id) {
                $idea = Idea::find($item->idea_id);

                if ($idea && $idea->hook_id !== $item->hook_id) {
                    throw ValidationException::withMessages([
                        'idea_id' => 'The selected idea does not belong to the same hook as this cycle item.'
                    ]);
                }
            }
        });
    }

    // RELATIONSHIPS

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

    public function contentPosts(): HasMany
    {
        return $this->hasMany(ContentPost::class);
    }

    public function getDisplayNameAttribute(): string
    {
        $position = $this->position ?? '?';
        $hook = $this->hook?->name ?? '-';

        return "#{$position} — {$hook}";
    }
}
