<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    public function dishChoices(): HasMany
    {
        return $this->hasMany(DishChoice::class);
    }
}
