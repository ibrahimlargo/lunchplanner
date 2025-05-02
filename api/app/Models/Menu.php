<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Menu extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'datetime',
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
