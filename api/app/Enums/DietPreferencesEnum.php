<?php

declare(strict_types=1);

namespace App\Enums;

enum DietPreferencesEnum: string
{
    case Meat = 'meat';
    case Pork = 'pork';
    case Fish = 'fish';
    case Vegetarian = 'vegetarian';
    case Vegan = 'vegan';

    public function getGermanName(): String {
        return match ($this) {
            self::Meat => __('Fleisch'),
            self::Pork => __('Schweinefleisch'),
            self::Fish => __('Fisch'),
            self::Vegetarian => __('Vegetarisch'),
            self::Vegan => __('Vegan'),
        };
    }

    public function getIcon(): String {
        return match ($this) {
            self::Meat => 'images/meat.png',
            self::Pork => 'images/pork.png',
            self::Fish => 'images/fish.png',
            self::Vegetarian => 'images/vegetarian.png',
            self::Vegan => 'images/vegan.png',
        };
    }


}
