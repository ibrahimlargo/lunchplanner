<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeedbackResult extends Model
{
    use HasFactory;

    public function dishChoice(): BelongsTo
    {
        return $this->belongsTo(DishChoice::class);
    }
}
