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
                    <label for="filter_by3">Search by name</label>
                    <input class="form-control" type="string" placeholder="full name" name="ItemNameFilter" @if(@isset($filters) ) value="{{$filters->ItemNameFilter}}" @endif>
                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by vendor name</label>
                    <input class="form-control" type="string" placeholder="full name" name="ItemVendorFilter" @if(@isset($filters) ) value="{{$filters->ItemVendorFilter}}" @endif>
                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by inventory</label>
                    <input class="form-control" type="string" placeholder="full name" name="ItemInventoryFilter" @if(@isset($filters) ) value="{{$filters->ItemInventoryFilter}}" @endif>
                </li>
                @if(Auth::user()->isAdmin())
                <li class="list-group-item">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="search_is_active" name="ActivationFilter" value="1" @if(@isset($filters) && $filters->ActivationFilter == '1')checked @endif>
                        <label class="form-check-label">Active Items Only</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="search_is_active" name="ActivationFilter" value="0" @if(@isset($filters) && $filters->ActivationFilter == '0')checked @endif>
                        <label class="form-check-label">Inactive Items Only</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="search_is_active" name="ActivationFilter" value="" @if(@isset($filters) && $filters->ActivationFilter == '')checked @endif>
                        <label class="form-check-label">All Items</label>
                    </div>

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
                <img class="card-img-top"  width="100" height="220" src="{{$item->image}}" alt="Card image cap">
                <div class="card-body">
                    <a href="{{URL('item/' . $item->id)}}" class="link-dark">
                        <h5 class="card-title">{{$item->name}}</h5>
                    </a>
                    <h6 class="card-text">{{$item->brand->name}}</h6>
                </div>
                @if(Auth::user()->isAdmin())
                <div class="row ">
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
                </div>
                @endif
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