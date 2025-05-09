<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\DietPreferencesEnum;
use App\Enums\PriceTypeEnum;
use App\Models\Caterer;
use App\Models\Dish;
use App\Models\DishChoice;
use Illuminate\Database\Eloquent\Builder;

class FinanceService
{

    public function __construct(private StatisticService $statisticService)
    {
    }

    public function getTotalCostsOfYear(int $year, PriceTypeEnum $priceType): int
    {
        return $priceType->adjustPriceForType((int) $this->dishChoicesOfYearWithPrices($year)
            ->sum('price'));
    }

    public function getAverageCostsPerMenuOfYear(int $year, PriceTypeEnum $priceType): int
    {
        return $this->getTotalCostsOfYear($year, $priceType)/$this->statisticService->getNumberOfMenusOfYear($year);
    }

    public function getAverageCostsPerDishOfYear(int $year): int
    {
        return (int) $this->dishChoicesOfYearWithPrices($year)->avg('price');
    }

    public function getAverageCostsPerDishOfDietPreferenceOfYear(int $year, DietPreferencesEnum $dietPreference, PriceTypeEnum $priceType): int
    {
        return $priceType->adjustPriceForType( (int) $this->dishChoicesOfYearWithPrices($year)
            ->where('diet_preference_id', $dietPreference->toId())
            ->avg('price'));
    }

    public function getAveragePricePerDishOfCaterer(Caterer $caterer): int
    {
        return (int) Dish::where('caterer_id', $caterer->id)->avg('price');
    }

    public function getAveragePricePerDishOfDietPreferenceOfCaterer(Caterer $caterer, DietPreferencesEnum $dietPreference): int
    {
        return (int) Dish::where('caterer_id', $caterer->id)
            ->where('diet_preference_id', $dietPreference->toId())
            ->avg('price');
    }

    private function dishChoicesOfYearWithPrices(int $year): DishChoice|Builder
    {
        return DishChoice::query()
        ->join('dishes', 'dishes.id', '=', 'dish_choices.dish_id')
        ->join('menus', 'menus.id', '=', 'dish_choices.menu_id')
        ->whereYear('date', $year);
    }

}
