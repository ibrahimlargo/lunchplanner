<?php

namespace Database\Factories;

use App\Models\DishChoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FeedbackResult>
 */
class FeedbackResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1, 5),
            'dish_choice_id' => DishChoice::factory()->create(),
        ];
    }
}
