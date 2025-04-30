<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DietPreference extends Model
{
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
