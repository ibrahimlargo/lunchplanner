<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DietPreference extends Model
{
    use HasFactory;

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
