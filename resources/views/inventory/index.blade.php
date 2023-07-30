@extends('mainTemplate')
@section('title')
<title>Inventories</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 50;" class="container">
    <div class="page-header">
        <h1 class="header">All Inventories</h1>
    </div>
    <form method="GET" action="{{URL('/inventory/')}}">
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
        <div class="row">
            <ul class="list-group list-group-horizontal">

                <li class="list-group-item">
                    <label for="filter_by2">Search by phone number</label>
                    <input class="form-control" type="string" placeholder="phone number" name="PhoneFilter" @if(@isset($filters)) value="{{$filters->PhoneFilter}}" @endif>

                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by name</label>
                    <input class="form-control" type="string" placeholder="full name" name="ItemNameFilter" @if(@isset($filters) ) value="{{$filters->ItemNameFilter}}" @endif>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="country">Search by country:</label>
                        <select class="form-select" aria-label="Default select example" name="CountryFilter" id="country">

                            <option value='' @if(!@isset($filters->CountryFilter) ) selected @endif>Country..</option>

                            @foreach($countries as $country)
                            <option value="{{ $country->id}}" @if(@isset($filters->CountryFilter) && $filters->CountryFilter == $country->id ) selected @endif>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>

            </ul>
        </div>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="search_is_active" name="ActivationFilter" value="1" @if(@isset($filters) && $filters->ActivationFilter == '1')checked @endif>
            <label class="form-check-label">Active Inventories Only</label>
        </div>

        <br>
        <button class="btn btn-primary" type="submit">Apply filters</button>
        <a href="{{URL('inventory/')}}" class="btn btn-danger">Remove filters</a>
        <br>
        <br>

    </form>
    @if(@isset($inventories) && ! $inventories->isEmpty())
    <ul class="list-group">
        @foreach($inventories as $inventory)
        <a href="{{URL('inventory/'. $inventory->id)}}">
            <li class="list-group-item  well"><span class="text-primary">Name:</span> {{$inventory->name}}</li>
        </a>
        <li class="list-group-item  well"><span class="text-primary">Phone Number:</span>{{$inventory->phone}}</li>
        <li class="list-group-item  well"><span class="text-primary">Account Status: </span>@if($inventory->is_active ==1) <span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</li>

        <li class="list-group-item  well"><span class="text-primary">Country: </span> {{$inventory->city->country->name}}
        </li>
        <li class="list-group-item  well"><span class="text-primary">City: </span> {{$inventory->city->name}}
        </li>

        <li class="list-group-item well">
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
           
                <!-- <div class="col-auto">
                    <a href="{{URL('inventory/'.$inventory->id .'/vendor')}}" class="btn btn-primary" name="edit">Add Vendors</a>
                </div> -->
            </div>
        </li>
        <hr>
        @endforeach
    </ul>
    <div>
        {{ $inventories->links('pagination::bootstrap-4') }}
    </div>
    @else
    <div class="alert alert-danger">
        <p>No inventories found!</p>
    </div>

    @endif

</div>
@include('components\include\countryDropDown')

@endsection