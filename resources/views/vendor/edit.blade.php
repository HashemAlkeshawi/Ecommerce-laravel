@extends('mainTemplate')
@section('title')
<title>Edit Vendor</title>
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
            <h1 class="header">Update Vendor</h1>
        </div>
        <form method="POST" action="{{URL('/vendor/ '.$vendor->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" id="email" value="{{$vendor->email}}">
            </div>
            <div class="form-group">
                <label class="form-label">First name</label>
                <input class="form-control" type="text" name="first_name" id="fist_name" value="{{$vendor->first_name}}">
            </div>
            <div class="form-group">
                <label class="form-label">Last name</label>
                <input class="form-control" type="text" name="last_name" id="last_name" value="{{$vendor->first_name}}">
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{$vendor->phone}}">
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" @if($vendor->is_active ==1) checked @endif>
                <label class="form-check-label" for="is_active">
                    Active vendor?
                </label>
            </div>
            <br><br>
            <div class="row">
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Save Updates </button>
                </div>

            </div>


        </form>
        <div class="row">
            @if(isset($vendor->address))
            <div class="col-auto">
                <a href="{{URL('address/'.$vendor->address->id .'/edit')}}" class="btn btn-primary" name="edit">Edit Address</a>
            </div>
            @else
            <div class="col-auto">
                <form method="GET" action="{{URL('address/create/')}}">
                    <input type="hidden" name="addressable_id" value="{{$vendor->id}}">
                    <input type="hidden" name="addressable_type" value="u">
                    <button class="btn btn-primary" type="submit">Set Address</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection