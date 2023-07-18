@extends('mainTemplate')
@section('title')
<title>Set address for {{$addressable->first_name}}</title>
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
            <h1 class="header">Set address for {{$addressable->first_name }} {{$addressable->last_name}}</h1>
        </div>
        <form method="POST" action="{{URL('/address')}}">
            @csrf
            <div class="form-group">
                <label for="country">Select Country:</label>
                <select class="form-select" aria-label="Default select example" name="country" id="country">
                    <option selected>Country..</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id}}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="city">Select City:</label>
                <select class="form-select" aria-label="Default select example" name="city" id="city">
                    <option selected>Country first</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label class="form-label">District</label>
                <input class="form-control" type="text" name="district" id="district">
            </div>
            <br>
            <div class="form-group">
                <label class="form-label">Street</label>
                <input class="form-control" type="text" name="street" id="street">
            </div>
            <br>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input class="form-control" type="text" name="phone"  id="phone">
            </div>

            <br>
            <input type="hidden" name="addressable_id" value="{{$addressable->id}}">
            <input type="hidden" name="addressable_type" value="{{$addressable->addressable_type}}">

            <button class="btn btn-primary" type="submit">Set Address</button>


        </form>
    </div>
</div>
@include('components\include\countryDropDown')

@endsection