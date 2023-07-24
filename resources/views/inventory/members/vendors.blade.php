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
        @if (isset($masseges))
        <div class="alert alert-primary">
            <ul>
                @foreach ($masseges as $massege)
                <li>{{ $massege }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <form method="GET" action="{{URL('/inventory/'.$filters->inventory_id.'/vendor' )}}">
        @csrf
        <div class="row">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <label for="filter_by1">Search by email</label>
                    <input class="form-control" type="email" placeholder="email" name="EmailFilter" @if(@isset($filters)) value="{{$filters->EmailFilter}}" @endif>

                </li>
                <li class="list-group-item">
                    <label for="filter_by2">Search by phone number</label>
                    <input class="form-control" type="string" placeholder="phone number" name="PhoneFilter" @if(@isset($filters)) value="{{$filters->PhoneFilter}}" @endif>

                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by name</label>
                    <input class="form-control" type="string" placeholder="full name" name="NameFilter" @if(@isset($filters) ) value="{{$filters->NameFilter}}" @endif>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="country">Search by country:</label>
                        <select class="form-select" aria-label="Default select example" name="AddressCountryFilter" id="country">

                            <option value='' @if(!@isset($filters->AddressCountryFilter) ) selected @endif>Country..</option>

                            @foreach($countries as $country)
                            <option value="{{ $country->id}}" @if(@isset($filters->AddressCountryFilter) && $filters->AddressCountryFilter == $country->id ) selected @endif>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>

            </ul>
        </div>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="search_is_active" name="ActivationFilter" value="1" @if(@isset($filters) && $filters->ActivationFilter == '1')checked @endif>
            <label class="form-check-label">Active Users Only</label>
        </div>

        <br>
        <button class="btn btn-primary" type="submit">Apply filters</button>
        <a href="{{URL('inventory/' .$filters->inventory_id .'/vendor')}}" class="btn btn-danger">Remove filters</a>
        <br>
        <br>

    </form>
    <br>
    <br>
    <form method="POST" action="{{URL('inventory/'.$filters->inventory_id.'/vendor')}}" id="add_items_inventory">
        @csrf

        <div class="row">
            <div class="col-auto">
                <h2>Select vendors</h2>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Add Vendors to Inventory</button>
            </div>
        </div>
        <div class="row">
            @foreach($vendors as $vendor)
            <div class="col-auto">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class=" form-check">
                            <label>Select</label>
                            <input class="form-check-input" type="checkbox" id="{{ 'vendor_' . $vendor->id }}" name="vendors[]" value="{{ $vendor->id }}">
                        </div>
                    </li>
                    <li class="list-group-item  well"><span class="text-primary">Name:</span> {{$vendor->first_name}} {{ $vendor->last_name}}</li>
                    <li class="list-group-item  well"><span class="text-primary">Phone Number:</span>{{$vendor->phone}}</li>
                    <li class="list-group-item  well"><span class="text-primary">Account Status: </span>@if($vendor->is_active ==1) <span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</li>
                    @if(isset($vendor->address))

                    <li class="list-group-item  well"><span class="text-primary">Country: </span> {{$vendor->address->city->country->name}}
                    </li>
                    <li class="list-group-item  well"><span class="text-primary">City: </span> {{$vendor->address->city->name}}
                    </li>
                    <hr>

                    @endif
                </ul>
            </div>

            @endforeach
        </div>
        {{ $vendors->links('pagination::bootstrap-4') }}
</div>
</form>

<br>
<br>
<div>
</div>
<br>

</div>


@endsection