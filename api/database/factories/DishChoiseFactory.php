<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DishChoice>
 */
class DishChoiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'dish_id' => Dish::factory()->create(),
            'menu_id' => Menu::factory()->create(),
        ];
    }
}
