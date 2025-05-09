<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Carbon;

class MenuService
{
    public function getNextMenu(): ?Menu
    {
        return Menu::query()->where('date', '>', Carbon::now())->orderBy('date')->first();
    }

    public function getPreviousMenu(): ?Menu
    {
        return Menu::query()->where('date', '<', Carbon::now())->orderByDesc('date')->first();
    }

    public function getMenuOfTheDay()
    {
        return Menu::query()->where('date', Carbon::now()->startOfDay())->first();
    }

    public function hasVoted(User $user, Menu $menu): bool
    {
        return $user->dishChoices()->where('menu_id', $menu->id)->exists();
    }
}
