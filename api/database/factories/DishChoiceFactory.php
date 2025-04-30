<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DishChoice>
 */
class DishChoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'dish_id' => Dish::query()->inRandomOrder()->first()->id,
            'menu_id' => Menu::query()->inRandomOrder()->first()->id,
        ];
    }
}
