<?php

namespace App\Models;

use App\Enums\DietPreferencesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property DietPreferencesEnum $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dishes
 * @property-read int|null $dishes_count
 *
 * @method static \Database\Factories\DietPreferenceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DietPreference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DietPreference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DietPreference query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DietPreference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DietPreference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DietPreference whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DietPreference whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class DietPreference extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => DietPreferencesEnum::class,
    ];

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
