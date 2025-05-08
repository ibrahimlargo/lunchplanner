<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $ingredients
 * @property int $caterer_id
 * @property int $diet_preference_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Caterer $caterer
 * @property-read \App\Models\DietPreference $dietPreference
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DishChoice> $dishChoices
 * @property-read int|null $dish_choices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Menu> $menus
 * @property-read int|null $menus_count
 *
 * @method static \Database\Factories\DishFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereCatererId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereDietPreferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereIngredients($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Dish whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Dish extends Model
{
    use HasFactory;

    public function caterer(): BelongsTo
    {
        return $this->belongsTo(Caterer::class);
    }

    public function dietPreference(): BelongsTo
    {
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
