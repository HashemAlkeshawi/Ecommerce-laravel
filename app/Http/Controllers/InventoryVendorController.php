<?php

// namespace App\Http\Controllers;

// use App\Models\Country;
// use App\Models\Inventory;
// use App\Models\Vendor;
// use Illuminate\Http\Request;

// class InventoryVendorController extends Controller
// {
//     //
//     public function create($inventory_id, Request $request)
//     {

//         $request['$inventory_id'] = $inventory_id;
//         $query = Vendor::query();

//         $vendors = Vendor::filter($request, $query)->paginate(8);

//         $countries = Country::select('id', 'name')->get();

//         return view('inventory.members.vendors', compact('vendors', 'countries'))->with('filters', $request);
//     }

//     public function store($inventory_id, Request $request)
//     {

//         $inventory = Inventory::find($inventory_id);
//         $vendors_id =  $request['vendors'];
//         if ($vendors_id != null) {
//             foreach ($vendors_id as $vendor_id) {
//                 $vendor_in_relation = $inventory->vendors()->wherePivot('vendor_id', $vendor_id)->exists();
//                 if (!$vendor_in_relation) {

//                     $inventory->vendors()->attach($vendor_id);
//                 }
//             }
//             return redirect("inventory/$inventory_id#vendors")->with('masseges', 'Added successfuly');
//         }
//         return redirect("inventory/$inventory_id#vendors")->with('masseges', 'Not Added');
//     }
//     public function destroy(Request $request)
//     {
//         $vendor_id = $request['vendor_id'];
//         if ($vendor_id != null) {
//             $inventory = Inventory::find($request['inventory_id']);
//             $inventory->vendors()->detach($vendor_id);
//         }
//         return redirect()->back();
//     }
// }
