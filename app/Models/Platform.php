<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperPlatform
 */
class Platform extends Model
{
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
