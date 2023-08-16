<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\storeAddressRequest;
use App\Models\Address\Address;
use App\Models\Address\Country;
use App\Models\Dashboard\User;
use App\Models\Dashboard\Vendor;
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
        $countries = Country::with('City')->get();
        return view('dashboard.address.create')->with('addressable', $addressable)->with('countries', $countries);
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

        if ($address->addressable_type == Vendor::class) {
            return redirect('vendor/' . $address->addressable_id);
        } else if ($address->addressable_type == User::class) {

            return redirect('user/' . $address->addressable_id);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        $countries = country::with('City')->get();
        return view('dashboard.address.edit')->with('address', $address)->with('countries', $countries);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {

        $address->city_id = $request['city'];
        $address->district = $request['district'];
        $address->street = $request['street'];
        $address->phone = $request['phone'];

        $address->save();
        switch ($address->addressable_type) {
            case Vendor::class:
                return redirect('vendor/' . $address->addressable_id);
            case User::class:
                return redirect('user/' . $address->addressable_id);
        }
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
                $addressable = User::find($addressable_id);
                break;
        }
        return $addressable;
    }
}
