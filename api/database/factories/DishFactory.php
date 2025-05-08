<?php

namespace Database\Factories;

use App\Models\Caterer;
use App\Models\DietPreference;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'ingredients' => $this->faker->text(),
            'caterer_id' => Caterer::query()->inRandomOrder()->first()->id,
            'diet_preference_id' => DietPreference::query()->inRandomOrder()->first()->id,
        ];
    }
}
