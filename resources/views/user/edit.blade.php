@extends('mainTemplate')
@section('title')
<title>Edit user</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
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
            <h1 class="header">Edit user</h1>
        </div>
        <form method="POST" action="{{URL('/user/'. $user->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Username</label>
                <input class="form-control" type="text" name="username" id="username" value="{{$user->username}}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}">
            </div>


            <div class="form-group">
                <label class="form-label">First name</label>
                <input class="form-control" type="text" name="first_name" id="first_name" value="{{$user->first_name}}">
            </div>
            <div class="form-group">
                <label class="form-label">Last name</label>
                <input class="form-control" type="text" name="last_name" id="last_name" value="{{$user->last_name}}">
            </div>
            <br>
            @if($user->is_active)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1">
                <label class="form-check-label">Deactivate User?</label>
            </div>
            @else
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="0">
                <label class="form-check-label">Activate User?</label>
            </div>
            @endif

            <br>
            <div class="row">
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Save Updates </button>
                </div>

            </div>
        </form>
        <div class="row">
            @if(isset($user->address))
            <div class="col-auto">
                <a href="{{URL('address/'.$user->address->id .'/edit')}}" class="btn btn-primary" name="edit">Edit Address</a>
            </div>
            @else
            <div class="col-auto">
                <form method="GET" action="{{URL('address/create/')}}">
                    <input type="hidden" name="addressable_id" value="{{$user->id}}">
                    <input type="hidden" name="addressable_type" value="u">
                    <button class="btn btn-primary" type="submit">Set Address</button>
                </form>
            </div>

            @endif
        </div>
    </div>
</div>
@endsection