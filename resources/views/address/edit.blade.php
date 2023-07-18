@extends('mainTemplate')
@section('title')
<title>Update Address</title>
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
            <h1 class="header">Update Address</h1>
        </div>
        <form method="POST" action="{{URL('/address/'.$address->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="country">Select Country:</label>
                <select class="form-select" aria-label="Default select example" name="country" id="country">
                    <option selected>{{$address->city->country->name}}</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id}}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="city">Select City:</label>
                <select class="form-select" aria-label="Default select example" name="city" id="city">
                    <option value="{{$address->city->id}}" selected>{{$address->city->name}}</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label class="form-label">District</label>
                <input class="form-control" type="text" name="district" id="district" value="{{$address->district}}">
            </div>
            <br>
            <div class="form-group">
                <label class="form-label">Street</label>
                <input class="form-control" type="text" name="street" id="street" value="{{$address->street}}">
            </div>
            <br>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input class="form-control" type="text" name="phone"  id="phone" value="{{$address->phone}}">
            </div>

            <br>
           
            <button class="btn btn-primary" type="submit">Set Address</button>


        </form>
    </div>
</div>
@include('components\include\countryDropDown')

@endsection