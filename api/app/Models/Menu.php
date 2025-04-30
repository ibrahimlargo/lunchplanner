<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => CarbonImmutable::class
    ];

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    public function dishChoices(): HasMany
    {
        return $this->hasMany(DishChoice::class);
    }
}
