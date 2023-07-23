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
        <h1 class="header">Brands</h1>
    </div>
    <form method="GET" action="{{URL('/brand/')}}" id="brand_filter_form">
        @csrf
        <div class="row">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <label for="filter_by3">Search by name</label>
                    <input class="form-control" type="string" placeholder="full name" name="ItemNameFilter" @if(@isset($filters) ) value="{{$filters->ItemNameFilter}}" @endif>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="country">Available Brands:</label>
                        <select class="form-select" aria-label="Default select example" name="IdFilter" id="brand">

                            <option value='' @if(!@isset($filters->IdFilter) ) selected @endif>Brand..</option>

                            @foreach($brands as $brand)
                            <option value="{{ $brand->id}}" @if(@isset($filters->IdFilter) && $filters->IdFilter == $brand->id ) selected @endif>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>

            </ul>
        </div>


        <br>
        <button class="btn btn-primary" type="submit">Apply filters</button>

        <a href="{{URL('brand/')}}" class="btn btn-danger">Remove filters</a>
        <br>
        <br>

    </form>
    <div class="row">
        @foreach($brands as $brand)
        <div class="col-auto">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top"  width="100" height="220" src="{{$brand->icon}}" alt="Card image cap">
                <div class="card-body">

                    <a class="" href="{{URL('brand/' . $brand->id)}}">{{$brand->name}}</a>
                    <p class="card-text">{{$brand->notes}}</p>
                </div>
                @if(Auth::user()->isAdmin())
                <div class="row">
                    <div class="col-auto" style="margin-left: 10px;">
                        <a href="{{URL('brand/'.$brand->id .'/edit')}}" class="btn btn-primary" name="edit">Edit</a>
                    </div>
                    <div class="col-auto">
                        <form method="POST" action="{{URL('brand/'.$brand->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" name="Delete" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div>
        {{ $brands->links('pagination::bootstrap-4') }}
    </div>
    @if(Auth::user()->isAdmin())
    <a href="{{URL('brand/create')}}" class="btn btn-primary" style="position: fixed; bottom: 50px; right: 50px; ">Add brand</a>
    @endif
</div>
@include('components\include\applyBrandFilters')


@endsection