<?php

namespace App\Models;

use App\Enums\PriceTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property string|null $additional_information
 * @property int $additional_costs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DishChoice> $dishChoices
 * @property-read int|null $dish_choices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dishes
 * @property-read int|null $dishes_count
 *
 * @method static \Database\Factories\MenuFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereAdditionalInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Menu whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Menu extends Model
{
    use HasFactory;

    protected $casts = [
        'date' => 'datetime',
    ];

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class);
    }

    public function dishChoices(): HasMany
    {
        return $this->hasMany(DishChoice::class);
    }

    public function amountOfOrders(): int
    {
        return $this->dishChoices->count();
    }

    public function totalCosts(PriceTypeEnum $priceType): int
    {
        return $priceType->adjustPriceForType($this->dishChoices->sum(function ($choice) {
            return $choice->dish->price;
        }));
    }

    public function averageCostsPerDish(PriceTypeEnum $priceType): int
    {
        return $this->totalCosts($priceType)/$this->amountOfOrders();
    }

}
