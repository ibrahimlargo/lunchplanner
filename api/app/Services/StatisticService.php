<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Menu;

class StatisticService
{
    public function getNumberOfMenusOfYear(int $year): int
    {
        return Menu::whereYear('date', $year)->count();
    }

}
