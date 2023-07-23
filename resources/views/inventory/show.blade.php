@extends('mainTemplate')
@section('title')
<title>Inventory of: {{$inventory->name}}</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 50;" class="container">
    <div class="page-header">
        <h1 class="header">Inventory of: {{$inventory->name}}</h1>
    </div>
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <ul class="list-group">
        <a href="{{URL('inventory/'. $inventory->id)}}">
            <li class="list-group-item  well"><span class="text-primary">Name:</span> {{$inventory->name}}</li>
        </a>
        <li class="list-group-item  well"><span class="text-primary">Phone Number:</span>{{$inventory->phone}}</li>
        <li class="list-group-item  well"><span class="text-primary">Account Status: </span>@if($inventory->is_active ==1) <span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</li>

        <li class="list-group-item  well"><span class="text-primary">Country: </span> {{$inventory->city->country->name}}
        </li>
        <li class="list-group-item  well"><span class="text-primary">City: </span> {{$inventory->city->name}}
        </li>
        <li class="list-group-item  well"><span class="text-primary">Vendors: </span> {{count($inventory->vendors)}}
        </li>
    
        <li class="list-group-item  well"><span class="text-primary">Items: </span> {{count($inventory->items)}}
        </li>
    
        <br>
        <div class="row">
            <div class="col-auto">
                <a href="{{URL('inventory/'.$inventory->id .'/edit')}}" class="btn btn-primary" name="edit">Edit</a>
            </div>
            <div class="col-auto">
                <form method="POST" action="{{URL('inventory/'.$inventory->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" name="Delete" type="submit">Delete</button>
                </form>
            </div>
        </div>
        <hr>
    </ul>

    <div>
        <h2 id="vendors">Vendors of the Inventory</h2>
        <a href="{{URL('inventory/'.$filters->inventory->id .'/vendor')}}" class="btn btn-primary">Add Item</a>
     <br>
     <br>
    </div>
    <br>
    <hr>
    <div>
        <h2 id="items" >Items of the Inventory</h2><br>
        <a href="{{URL('inventory/'.$filters->inventory->id .'/item')}}" class="btn btn-primary">Add Item</a>
       <br>
       <br>
        <div class="row">
            @foreach($inventory->items as $item)
            <div class="col-auto">
                <div class="card" style="width: 18rem;">

                    <img class="card-img-top" width="100" height="220" src="{{$item->image}}" alt="Card image cap">
                    <div class="card-body">
                        <a href="{{URL('item/' . $item->id)}}" class="link-dark">
                            <h5 class="card-title">{{$item->name}}</h5>
                        </a>
                        <h6 class="card-text">{{$item->brand->name}}</h6>
                        <h6 class="card-text">Quantitiy: {{$item->pivot->quantity}}</h6>
                    </div>
                    <div class="row ">
                        <div class="col-auto">
                            @if($item->isActive())
                            <div class="d-inline-flex align-items-center">
                                <div class="rounded-circle bg-success" style="width: 15px; height: 15px; margin:8px;"></div>
                                <span class="status-text">Active</span>
                            </div>
                            @else
                            <div class="d-inline-flex align-items-center">
                                <div class="rounded-circle bg-danger" style="width: 15px; height: 15px;  margin:8px;"></div>
                                <span class="status-text">Inactive</span>
                            </div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <form method="POST" action="{{URL('inventory/'. $inventory->id .'/item')}}">
                                @csrf
                                @method("DELETE")
                                <input type="hidden" name="inventory_id" value="{{$inventory->id}}">
                                <input type="hidden" name="item_id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>

    </div>


</div>

@endsection