<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
