@extends('mainTemplate')
@section('title')
<title>Items</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 10;" class="container">
    <div class="page-header">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <form method="GET" action="{{URL('vendor/'.$filters->vendor_id.'/item')}}" id="brand_filter_form">
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
                    <label for="filter_by3">Search by name</label>
                    <input class="form-control" type="string" placeholder="full name" name="ItemNameFilter" @if(@isset($filters) ) value="{{$filters->ItemNameFilter}}" @endif>
                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by Vendor</label>
                    <input class="form-control" type="string" placeholder="Vendor name" name="ItemVendorFilter" @if(@isset($filters) ) value="{{$filters->ItemVendorFilter}}" @endif>
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
        <a href="{{URL('vendor/'.$filters->vendor_id.'/item')}}" class="btn btn-danger">Remove filters</a>
    </form>

    <br>


    <form method="POST" action="{{URL('vendor/'.$filters->vendor_id.'/item')}}" id="add_items_vendor">
        @csrf
        <div class="form-group">
            <label for="country">Select Inventory:</label>
            <select class="form-select" aria-label="Default select example" name="inventory_id" id="inventory_id">
                <option selected>Inventory..</option>
                @foreach($inventories as $inventory)
                <option value="{{$inventory->id}}">{{ $inventory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Quantity from vendor: </label>
            <input class="form-control" type="number" name="quantity" placeholder="item quantity" id="quantity">
        </div>
        <hr>
        <div class="row">
            <div class="col-auto">
                <h2>Select items</h2>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Add Item to Vendor</button>
            </div>
        </div>
        <div class="row">
            @foreach($items as $item)
            <div class="col-auto">
                <div class="card" style="width: 18rem;">
                    <div class=" form-check">
                        <label>Select</label>
                        <input class="form-radio-input" type="radio" id="item_id" name="item_id" value="{{ $item->id }}">
                    </div>

                    <img class="card-img-top" width="100" height="200" src="{{asset('storage/'.$item->image)}}" alt="Card image cap">
                    <div class="card-body">
                        <a href="{{URL('item/' . $item->id)}}" class="link-dark">
                            <h5 class="card-title">{{$item->name}}</h5>
                        </a>
                        <h5 class="card-title">Price: {{$item->price}}</h5>
                        <h6 class="card-text">{{$item->brand->name}}</h6>
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
                    </div>
                </div>
                <br>
            </div>
            @endforeach
        </div>
    </form>

    <br>
    <br>
    <div>
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
    <br>
    @if(Auth::user()->isAdmin())

    @endif
</div>


@endsection