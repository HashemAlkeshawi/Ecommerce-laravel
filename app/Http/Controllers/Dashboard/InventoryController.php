<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\storeInventoryRequest;
use App\Http\Requests\FiltersRequest;
use App\Models\Address\Country;
use App\Models\Dashboard\Inventory;
use App\Models\Item\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FiltersRequest $request)
    {
        $query = Inventory::query();

        $inventories =   Inventory::filter($request->all(), $query)->paginate(5);
        $countries = Country::select('id', 'name')->get();

        return view('dashboard.inventory.index')->with('inventories', $inventories)->with('filters', $request)->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $countries = Country::with('City')->get();
        return view('dashboard.inventory.create')->with('countries', $countries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeInventoryRequest $request)
    {
        $inventory = new inventory();
        $inventory->city_id = $request['city'];
        $inventory->name = $request['name'];
        $inventory->phone = $request['phone'];
        $inventory->is_active = 1;

        $inventory->save();

        return redirect("inventory/$inventory->id");
    }

    /**
     * Display the specified resource.
     */
    public function show(inventory $inventory, Request $request)
    {
        $inventory->load('items', 'vendors');
        $brands = Brand::select('id', 'name')->get();
        foreach ($inventory->items as $item) {
            $item->image = Storage::url($item->image);
        }
        return view('dashboard.inventory.show', compact('inventory', 'brands'))->with('filters', $request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventory $inventory)
    {
        $countries = Country::with('City')->get();
        return view('dashboard.inventory.edit', compact('countries', 'inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, inventory $inventory)
    {
        $inventory->city_id = $request['city'];
        $inventory->name = $request['name'];
        $inventory->phone = $request['phone'];
        $inventory->is_active = $request['is_active'] ?? 0;

        $inventory->save();

        return redirect("inventory/$inventory->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inventory $inventory)
    {
        $inventory->delete();
        return redirect('/inventory');
    }
}
