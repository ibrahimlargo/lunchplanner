<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishChoice;
use App\Models\Menu;
use Illuminate\Http\Request;

class DishChoiceController extends Controller
{
    public function index()
    {
        return DishChoice::all()->toResourceCollection();
    }

    public function show(DishChoice $dishChoice)
    {
        return $dishChoice->toResource();
    }

    public function store(Request $request, Menu $menu)
    {
        DishChoice::create([
            'user_id' => $request->user()->id,
            'dish_id' => $request->dish,
            'menu_id' => $menu

        ]);

        return response()->noContent();
    }

    public function update(Request $request, DishChoice $dishChoice)
    {
        $dishChoice->update([
            'dish_id' => $request->dish,
        ]);

        return response()->noContent();
    }

    public function destroy(DishChoice $dishChoice)
    {
        $dishChoice->delete();

        return response()->noContent();
    }
}
