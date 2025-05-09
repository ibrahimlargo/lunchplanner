<?php

namespace Database\Seeders;

use App\Enums\DietPreferencesEnum;
use App\Models\Caterer;
use App\Models\DietPreference;
use App\Models\Dish;
use App\Models\DishChoice;
use App\Models\FeedbackResult;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@lunch.com',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Worker User',
            'email' => 'worker@lunch.com',
        ]);

        User::factory(50)->create();
        Caterer::factory(8)->create();

        collect(DietPreferencesEnum::cases())->each(function ($dietPreference) {
            DietPreference::factory()->create([
                'name' => $dietPreference->value,
            ]);
        });

        Dish::factory(240)->create();
        Menu::factory(80)->create();
        Menu::all()->each(function (Menu $menu) {
            $caterer = Caterer::inRandomOrder()->first();
            $dishes = Dish::where('caterer_id', $caterer->id)->inRandomOrder()->take(3)->get();
            $menu->dishes()->attach($dishes->pluck('id'));
            User::all()->take(random_int(35,50))->each(function (User $user) use ($menu, $dishes) {
                DishChoice::factory()->create([
                    'user_id' => $user->id,
                    'menu_id' => $menu->id,
                    'dish_id' => $dishes->random()->id,
                ]);
            });
        });
        DishChoice::all()->take(random_int(20,50))->each(function ($choice) {
            FeedbackResult::factory()->create([
                'dish_choice_id' => $choice->id,
            ]);
        });
    }
}
