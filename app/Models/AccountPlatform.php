<?php

namespace App\Models;

use App\Models\ContentPost;
use App\Models\LabPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class AccountPlatform extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contentPosts(): MorphToMany
    {
        return $this->morphToMany(ContentPost::class, 'account_platformable');
    }

    public function labPosts(): MorphToMany
    {
        return $this->morphToMany(LabPost::class, 'account_platformable');
    }
}
