<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dish extends Model
{
    public function caterer(): BelongsTo {
        return $this->belongsTo(Caterer::class);
    }

    public function dietPreference(): BelongsTo {
        return $this->belongsTo(DietPreference::class);
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }

    public function dishChoices(): HasMany
    {
        return $this->hasMany(DishChoice::class);
    }
}
