<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string|null $comment
 * @property int $rating
 * @property int $dish_choice_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DishChoice $dishChoice
 *
 * @method static \Database\Factories\FeedbackResultFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeedbackResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeedbackResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeedbackResult query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeedbackResult whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeedbackResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeedbackResult whereDishChoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeedbackResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeedbackResult whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FeedbackResult whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class FeedbackResult extends Model
{
    use HasFactory;

    public function dishChoice(): BelongsTo
    {
        return $this->belongsTo(DishChoice::class);
    }
}
