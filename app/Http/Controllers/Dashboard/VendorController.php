<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\storeVendorRequest;
use App\Http\Requests\FiltersRequest;
use App\Models\Address\Country;
use App\Models\Dashboard\Vendor;
use Illuminate\Http\Request;


class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FiltersRequest $request)
    {
        $query = Vendor::query();
        $vendors =   Vendor::filter($request->all(), $query)->paginate(5);
        $countries = Country::select('id', 'name')->get();

        return view('dashboard.vendor.index', compact('countries', 'vendors'))->with('filters', $request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeVendorRequest $request)
    {
        $vendor = new Vendor();

        $vendor->email = $request['email'];
        $vendor->first_name = $request['first_name'];
        $vendor->last_name = $request['last_name'];
        $vendor->is_active = $request->has('is_active') ? 1 : 0;
        $vendor->phone = $request['phone'];

        $vendor->save();

        return redirect('dashboard.vendor');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return view('dashboard.vendor.show')->with('vendor', $vendor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('dashboard.vendor.edit')->with('vendor', $vendor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $vendor->email = $request['email'];
        $vendor->first_name = $request['first_name'];
        $vendor->last_name = $request['last_name'];
        $vendor->is_active = $request->has('is_active') ? 1 : 0;
        $vendor->phone = $request['phone'];

        $vendor->save();

        return redirect('vendor/' . $vendor->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect('/vendor');
    }
}
