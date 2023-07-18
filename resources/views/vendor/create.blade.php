@extends('mainTemplate')
@section('title')
<title>Add new Vendor</title>
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
            <h1 class="header">Add New Vendor</h1>
        </div>
        <form method="POST" action="{{URL('/vendor')}}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label class="form-label">First name</label>
                <input class="form-control" type="text" name="first_name" id="fist_name">
            </div>
            <div class="form-group">
                <label class="form-label">Last name</label>
                <input class="form-control" type="text" name="last_name" id="last_name">
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input class="form-control" type="text" name="phone" id="phone">
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
                <label class="form-check-label" for="is_active">
                    Active vendor?
                </label>
            </div>
            <br><br>
            <button class="btn btn-primary" type="submit">Add new Vendor</button>


        </form>
    </div>
</div>


@endsection