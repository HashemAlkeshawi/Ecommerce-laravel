@extends('mainTemplate')
@section('title')
<title>Home</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 10;" class="container">
    <div class="page-header">
        @if (session('messages'))
        <div class="alert alert-success">
            <ul>
                @foreach (session('messages') as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(isset($filters->brand))
        <h1 class="header">Items of: {{$filters->brand->name}}</h1>
        @endif
    </div>

    <form method="GET" action="{{URL('item')}}" id="brand_filter_form">
        @csrf
        <div class="row">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="country">Brands:</label>
                        <select class="form-select" aria-label="Default select example" name="BrandIdFilter" id="brand">
                            <option disabled value='' @if(!@isset($filters->BrandIdFilter) ) selected @endif>Brand..</option>


                            @foreach($brands as $brand)
                            <option value="{{ $brand->id}}" @if(@isset($filters->BrandIdFilter) && $filters->BrandIdFilter == $brand->id ) selected @endif>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by Item name</label>
                    <input class="form-control" type="string" placeholder="item name" name="ItemNameFilter" @if(@isset($filters) ) value="{{$filters->ItemNameFilter}}" @endif>
                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by Vendor name</label>
                    <input class="form-control" type="string" placeholder="vendor name" name="ItemVendorFilter" @if(@isset($filters) ) value="{{$filters->ItemVendorFilter}}" @endif>
                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by Inventory</label>
                    <input class="form-control" type="string" placeholder="inventory name" name="ItemInventoryFilter" @if(@isset($filters) ) value="{{$filters->ItemInventoryFilter}}" @endif>
                </li>
                <li class="list-group-item  d-flex align-items-center" >

                    <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="search_is_active" name="ItemQuantityFilter" value="1" @if(@isset($filters) && $filters->ItemQuantityFilter == '1')checked @endif>
                            <label class="form-check-label">Items with quantity exeeds 50 in inventories</label>
                        </div>
                </li>
                @if(Auth::user()->isAdmin())
                <li class="list-group-item">
                    <label for="filter_by3">Activation status</label>
                    <select class="form-control" name="ActivationFilter">
                        <option value="1" @if(@isset($filters) && $filters->ActivationFilter == '1')selected @endif>Active Items Only</option>
                        <option value="0" @if(@isset($filters) && $filters->ActivationFilter == '0')selected @endif>Inactive Items Only</option>
                        <option value="" @if(@isset($filters) && $filters->ActivationFilter == '')selected @endif>All Items</option>
                    </select>
                </li>
                @endif
            </ul>
        </div>
        <br>

        <button class="btn btn-primary" type="submit">Apply filters</button>


        <a href="{{URL('item')}}" class="btn btn-danger">Remove filters</a>
    </form>

    <br>
    <br>
    <div class="row">
        @foreach($items as $item)
        <div class="col-auto">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" width="100" height="220" src="{{$item->image}}" alt="Card image cap">
                <div class="card-body">
                    <a href="{{URL('item/' . $item->id)}}" class="link-dark">
                        <h5 class="card-title">{{$item->name}}</h5>
                    </a>
                    <h5 class="card-title">Price: {{$item->price}}</h5>

                    <h6 class="card-text">{{$item->brand->name}}</h6>
                </div>
                <div class="row ">
                    @if(Auth::user()->isAdmin())
                    <div class="col-auto" style="margin-left: 10px;">
                        <a href="{{URL('item/'.$item->id .'/edit')}}" class="btn btn-primary" name="edit">Edit</a>
                    </div>
                    <div class="col-auto">
                        <form method="POST" action="{{URL('item/'.$item->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" name="Delete" type="submit">Delete</button>
                        </form>
                    </div>
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
                    @else
                    <div class="col-auto" style="margin-left: 10px;">

                        <form method="POST" action="{{URL('cart')}}">
                            @csrf

                            <input type="hidden" value="{{$item->id}}" name="item_id">
                            <div class="col-auto">
                                <label class="">Quantity:</label>
                                @if(session()->has('cart') && array_key_exists($item->id,session()->get('cart')))
                                <div class="d-inline-flex align-items-center">
                                    <div class="rounded-circle bg-success" style="width: 15px; height: 15px; margin:8px;"></div>
                                    <span class="status-text">Added to cart</span>
                                </div>
                                @endif
                            </div>
                            <div class="form-group row">

                                <div class="col-sm-5">
                                    <input class="form-control" type="number" value="" name="quantity">
                                </div>
                                <div class="col-sm-7">

                                    <button class="btn btn-primary" name="Delete" type="submit">Add to Cart</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <br>
        </div>

        @endforeach
    </div>

    <br>
    <br>
    <div>
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
    <br>
    @if(Auth::user()->isAdmin())

    <a href="{{URL('item/create')}}" class="btn btn-primary" style="position: fixed; bottom: 50px; right: 50px; ">Add item</a>
    @endif
</div>


@endsection