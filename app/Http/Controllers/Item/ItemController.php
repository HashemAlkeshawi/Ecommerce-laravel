<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\storeItemRequest;
use App\Http\traits\uploadFile;
use App\Models\Dashboard\Vendor;
use App\Models\Item\Brand;
use App\Models\Item\Item;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    use uploadFile;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands = Brand::select('id', 'name')->get();
        $query = Item::query();

        if (Auth::user()->is_admin != 1)
            $request['ActivationFilter'] = 1;

        $items = Item::filter($request->all(), $query)->paginate(8);
        foreach ($items as $item) {
            $item->image = asset('storage/' . $item->image);
        }
        return view('item.index')->with('items', $items)->with('filters', $request)->with('brands', $brands);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::selectRaw(" id, CONCAT(first_name, ' ', last_name) as name ")->get();
        $brands = Brand::select('id', 'name')->get();
        return view('item.create', compact('brands', 'vendors'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function createForBrand($brand_id)
    {
        //
        $brand = Brand::find($brand_id);
        return view('item.createForBrand')->with('brand', $brand);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeItemRequest $request)
    {
        $item = new Item();
        $item->name =  $request['name'];
        $item->price =  $request['price'];
        $item->brand_id = $request['brand_id'];
        $item->image = $this->getUploadedImagePath($request->file('image'), 'item_images');

        $item->save();

        return redirect("item/$item->id");
    }



    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        if ($item->is_active == 0 && Auth::user()->is_admin != 1)
            return redirect()->back();
        $item->image = Storage::url($item->image);

        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $item->image = Storage::url($item->image);
        $brands = Brand::select('id', 'name')->get();

        return view('item.edit')->with('item', $item)->with('brands', $brands);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $rules  = [
            'brand_id' => 'required|numeric',
            'image' => 'mimes:jpg,jpeg,png',
            'price' => 'required|numeric'
        ];
        if ($request['name'] != $item->name || $request['brand_id'] != $item->brand_id) {
            $rules['name'] =  [
                'required',
                Rule::unique('items')->where(function ($query) use ($request) {
                    return $query->where('brand_id', $request->input('brand_id'));
                }),
            ];
        }
        $request->validate($rules);
        $item->name =  $request['name'];
        $item->price =  $request['price'];
        $item->brand_id = $request['brand_id'];
        $item->purchasable = $request['purchasable'] == '1' ? 1 : 0;
        if ($request->has('image')) {
            if (Storage::exists('public/' . $item->image)) {
                Storage::delete('public/' . $item->image);
            }
            $item->image = $this->getUploadedImagePath($request->file('image'), 'item_icons');
        }
        $item->save();
        return redirect("/item/$item->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Storage::delete('public/'.$item->icon);
        $item->delete();
        return redirect()->back();
    }
}
