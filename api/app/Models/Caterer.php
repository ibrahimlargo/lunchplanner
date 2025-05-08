<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $order_url
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Dish> $dishes
 * @property-read int|null $dishes_count
 *
 * @method static \Database\Factories\CatererFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer whereOrderUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Caterer whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Caterer extends Model
{
    use HasFactory;

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
