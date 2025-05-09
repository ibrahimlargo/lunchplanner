<?php

namespace Database\Seeders;

use App\Enums\DietPreferencesEnum;
use App\Models\Caterer;
use App\Models\DietPreference;
use App\Models\Dish;
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

        User::factory(10)->create();
        Caterer::factory(7)->create();

        collect(DietPreferencesEnum::cases())->each(function ($dietPreference) {
            DietPreference::factory()->create([
                'name' => $dietPreference->value,
            ]);
        });

        Dish::factory(80)->create();
        Menu::factory(18)->create();
        Menu::all()->each(function (Menu $menu) {
            $caterer = Caterer::inRandomOrder()->first();
            $menu->dishes()->attach(Dish::where('caterer_id', $caterer->id)->inRandomOrder()->take(3)->get()->pluck('id'));
        });
        FeedbackResult::factory(20)->create();
    }
}
