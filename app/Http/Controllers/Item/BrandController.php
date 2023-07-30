<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\traits\uploadFile;
use App\Models\Item\Brand;
use App\Models\Item\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use storeBrandRequest;

class BrandController extends Controller
{
    use uploadFile;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Brand::query();

        $brands = Brand::filter($request->all(), $query)->paginate(15);
        foreach ($brands as $brand) {
            $brand->icon = Storage::url($brand->icon);
        }

        return view('brand.index')->with('brands', $brands)->with('filters', $request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeBrandRequest $request)
    {
        $brand = new Brand();
        $brand->name =  $request['name'];
        $brand->notes = $request['notes'];
        $brand->icon = $this->getUploadedImagePath($request->file('icon'), 'brand_icons');

        $brand->save();
        return redirect("brand/$brand->id");
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand, Request $request)
    {

        $query = Item::query();
        $items = $brand->items();
        if (Auth::user()->is_admin != 1)
            $request['ActivationFilter'] = 1;
        $filtered_items = $items->filter($request, $query)->paginate(8);
        foreach ($filtered_items as $item) {
            $item->image = Storage::url($item->image);
        }
        $request['brand'] = $brand;
        return view('brand.show')->with('items', $filtered_items)->with('filters', $request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $brand->icon = Storage::url($brand->icon);

        return view('brand.edit')->with('brand', $brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {

        $rules = [
            'name' => 'required',
            'notes' => 'required',
        ];
        if ($request['name'] != $brand->name) {
            $rules['name'] = 'required|unique:brands';
        }
        $request->validate($rules);
        $brand->name =  $request['name'];
        $brand->notes = $request['notes'];
        if ($request->has('icon')) {
            if (Storage::exists('public/' . $brand->icon)) {
                Storage::delete('public/' . $brand->icon);
            }
            $brand->icon = $this->getUploadedImagePath($request->file('icon'), 'brand_icons');
        }
        $brand->save();
        return redirect('/brand');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // Storage::delete('public/'.$brand->icon);
        $brand->delete();
        return redirect()->back();
    }
}
