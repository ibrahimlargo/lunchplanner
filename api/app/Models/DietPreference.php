<?php

namespace App\Models;

use App\Enums\DietPreferencesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DietPreference extends Model
{
    protected $casts = [
        'name' => DietPreferencesEnum::class
    ];
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
