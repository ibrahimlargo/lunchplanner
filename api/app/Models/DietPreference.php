<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\DietPreferencesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DietPreference extends Model
{
    use HasFactory;
    protected $casts = [
        'name' => DietPreferencesEnum::class
    ];

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
