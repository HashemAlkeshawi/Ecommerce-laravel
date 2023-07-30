@extends('mainTemplate')
@section('title')
<title>Edit {{$inventory->name}}</title>
@endsection
@include('components\navBar')

@section('content')

<div style="margin-top: 100;" class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-12">
        <div class="page-header">
            <h1 class="header">Edit {{$inventory->name}}</h1>
        </div>
        <form method="POST" action="{{URL('/inventory/'. $inventory->id)}}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="country">Select Country:</label>
                <select class="form-select" aria-label="Default select example" name="country" id="country">
                    <option selected>{{$inventory->city->country->name}}</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id}}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="city">Select City:</label>
                <select class="form-select" aria-label="Default select example" name="city" id="city">
                    <option value="{{$inventory->city->id}}" selected>{{$inventory->city->name}}</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label class="form-label">Inventory name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{$inventory->name}}">
            </div>
            <br>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{$inventory->phone}}">
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" @if($inventory->is_active ==1) checked @endif>
                <label class="form-check-label" for="is_active">
                    Active inventory?
                </label>
            </div>
            <br>
            <button class="btn btn-primary" type="submit">Save Inventory</button>
        </form>
    </div>
</div>
@include('components\include\countryDropDown')

@endsection