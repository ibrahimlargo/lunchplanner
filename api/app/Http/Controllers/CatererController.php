<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatererRequests\StoreCatererRequest;
use App\Http\Requests\CatererRequests\UpdateCatererRequest;
use App\Http\Resources\CatererResource;
use App\Models\Caterer;
use Illuminate\Http\Request;

class CatererController extends Controller
{
    public function index()
    {
        return CatererResource::collection(Caterer::all());
    }

    public function store(StoreCatererRequest $request)
    {
        Caterer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'order_url' => $request->order_url,
            'address' => $request->address,
        ]);

        return response()->noContent();
    }

    public function destroy(Caterer $caterer)
    {
        $caterer->delete();

        return response()->noContent();
    }

    public function update(UpdateCatererRequest $request, Caterer $caterer)
    {
        $caterer->name = $request->name;
        $caterer->email = $request->email;
        $caterer->phone = $request->phone;
        $caterer->order_url = $request->order_url;
        $caterer->address = $request->address;
        $caterer->save();

        return response()->noContent();
    }

    public function show(Caterer $caterer)
    {
        return CatererResource::make($caterer);
    }
}
