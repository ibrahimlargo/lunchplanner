<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return Menu::all()->toResourceCollection();
    }

    public function show(Menu $menu)
    {
        return $menu->toResource();
    }

    public function store(Request $request)
    {
        Menu::create($request->only(['date', 'additional_information']));

        return response()->noContent();
    }

    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->only(['date', 'additional_information']));

        return response()->noContent();
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return response()->noContent();
    }
}
