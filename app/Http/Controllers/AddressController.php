<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeAddressRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\d_user;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $addressable_id = $request['addressable_id'];
        $addressable_type = $request['addressable_type'];

        $addressable = $this->addressable_type($addressable_type, $addressable_id);
        $addressable->addressable_type = $addressable_type;
        $countries = country::with('City')->get();
        return view('address.create')->with('addressable', $addressable)->with('countries', $countries);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(storeAddressRequest $request)
    {

        $address = new Address();
        $address->city_id = $request['city'];
        $address->district = $request['district'];
        $address->street = $request['street'];
        $address->phone = $request['phone'];

        $addressable_id = $request['addressable_id'];
        $addressable_type = $request['addressable_type'];


        $addressable = $this->addressable_type($addressable_type, $addressable_id);
        $addressable->address()->save($address);
        return redirect('/d_user/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
        $countries = country::with('City')->get();
        return view('address.edit')->with('address', $address)->with('countries', $countries);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        //


        $address->city_id = $request['city'];
        $address->district = $request['district'];
        $address->street = $request['street'];
        $address->phone = $request['phone'];

        $address->save();
        return redirect('/d_user/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }


    private function addressable_type($type, $addressable_id)
    {
        $addressable = null;
        switch ($type) {
            case 'v':
                $addressable = Vendor::find($addressable_id);
                break;
            case 'u':
                $addressable = d_user::find($addressable_id);
                break;
        }
        return $addressable;
    }
}
