<?php

namespace App\Http\Controllers;

use App\Http\Requests\FiltersRequest;
use App\Models\Vendor;
use App\Http\Requests\storeVendorRequest;
use Illuminate\Http\Request;


class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FiltersRequest $request)

    {

        $query = Vendor::query();
        
        
        $vendors =   Vendor::filter($request, $query)->paginate(10);

        return view('vendor.index')->with('vendors', $vendors)->with('filters', $request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeVendorRequest $request)
    {
        $validated = $request->validated();
        // dd($request);
        // dd($validated);
        /***
       id bigInt [primary key]
    email varchar
    first_name varchar
    last_name varchar
    is_active tinyInteger
    phone varchar
         */
        $vendor = new Vendor();

        $vendor->email = $request['email'];
        $vendor->first_name = $request['first_name'];
        $vendor->last_name = $request['last_name'];
        $vendor->is_active = $request->has('is_active') ? 1 : 0;
        $vendor->phone = $request['phone'];

        $vendor->save();



        return redirect('vendor');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
