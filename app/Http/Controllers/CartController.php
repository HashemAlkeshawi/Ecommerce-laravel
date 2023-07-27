<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    //

    public function index()
    {
        $items = session()->get("cart");
    
        return view('cart.index', compact('items'));
    }

    public function create(Request $request)
    {
        $brands = Brand::select('id', 'name')->get();
        $query = Item::query();

        $items = Item::filter($request, $query)->paginate(8);
        foreach ($items as $item) {
            $item->image = Storage::url($item->image);
        }


        return view('item.index')->with('items', $items)->with('filters', $request)->with('brands', $brands);
    }

    public function store(Request $request)
    {

        $item_id =  $request['item_id'];
        $quantity = $request['quantity'];
        if ($item_id != null && $quantity != null) {
            $item = Item::find($item_id);
            $item->quantity = $quantity;
            $cart =  session()->get("cart", []);
            if (array_key_exists($item->id, $cart)) {
                $item->updated_to_cart_at = date('Y-m-d H:i:s');
                $item->quantity = $quantity;
                $cart[$item->id] = $item;
            } else {
                $date = date('Y-m-d H:i:s');
                $item->created_to_cart_at = $date;
                $item->updated_to_cart_at = $date;
                $item->quantity = $quantity;
                $cart[$item->id] = $item;
            }
            session(["cart" => $cart]);
            // dd(session('cart'));
            return redirect()->back()->with('messages', ["$quantity of $item->name added to the Cart"]);
        }
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $item_id = $request['item_id'];
        session()->forget("cart.$item_id");

        return redirect()->back();
    }
    public function empty(Request $request)
    {
        session()->forget("cart");

        return redirect()->back();
    }
}
