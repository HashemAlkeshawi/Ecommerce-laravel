<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\traits\uploadFile;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    use uploadFile;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = Brand::get();
        foreach($brands as $brand){
            $icon_url = Storage::url($brand->icon);
            $brand->icon = $icon_url;
        }
        
    //    $image_url = Storage::url('uploads/brand_icons/1689861309103.png');
        return view('brand.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeBrandRequest $request)
    {
        //
        $brand = new Brand();
        $brand->name =  $request['name'];
        $brand->notes = $request['notes'];
        $brand->icon = $this->getUploadedImagePath($request->file('icon'), 'brand_icons');

        $brand->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
        return view('brand.edit')->with('brand', $brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
        dd("this is update page");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
        $brand->delete();
        return redirect()->back();
    }

  
}
