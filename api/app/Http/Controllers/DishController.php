<?php

namespace App\Http\Controllers;

use App\Enums\DietPreferencesEnum;
use App\Http\Resources\DishResource;
use App\Models\Caterer;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        return DishResource::collection(Dish::all());
    }

    public function store(Request $request, Caterer $caterer)
    {
        Dish::create([
            'name' => $request->name,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'caterer_id' => $caterer->id,
            'diet_preference_id' => DietPreferencesEnum::fromId($request->diet_preference_id)?->toId(),
        ]);

        return response()->noContent();
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();

        return response()->noContent();
    }

    public function update(Request $request, Dish $dish)
    {
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->ingredients = $request->ingredients;
        $dish->diet_preference_id = DietPreferencesEnum::fromId($request->diet_preference_id)?->toId();

        $dish->save();

        return response()->noContent();
    }

    public function show(Dish $dish)
    {
        return DishResource::make($dish);
    }
}
