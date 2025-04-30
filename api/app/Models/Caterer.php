<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caterer extends Model
{
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }


}
