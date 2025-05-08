<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $user_id
 * @property int $dish_id
 * @property int $menu_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dish $dish
 * @property-read \App\Models\FeedbackResult|null $feedbackResult
 * @property-read \App\Models\Menu $menu
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\DishChoiceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishChoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishChoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishChoice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishChoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishChoice whereDishId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishChoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishChoice whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishChoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DishChoice whereUserId($value)
 *
 * @mixin \Eloquent
 */
class DishChoice extends Model
{
    use HasFactory;

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function feedbackResult(): HasOne
    {
        return $this->hasOne(FeedbackResult::class);
    }
}
