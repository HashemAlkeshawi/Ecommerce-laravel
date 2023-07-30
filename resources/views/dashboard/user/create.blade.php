@extends('mainTemplate')
@section('title')
<title>Add new user</title>
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
            <h1 class="header">Add New user</h1>
        </div>
        <form method="POST" action="{{URL('/user')}}">
            @csrf
            <div class="form-group">
                <label class="form-label">Username</label>
                <input class="form-control" type="text" name="username" id="username">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label>Check Password</label>
                <input class="form-control" type="password" name="check_password" id="check_password">
            </div>

            <div class="form-group">
                <label class="form-label">First name</label>
                <input class="form-control" type="text" name="first_name" id="fist_name">
            </div>
            <div class="form-group">
                <label class="form-label">Last name</label>
                <input class="form-control" type="text" name="last_name" id="last_name">
            </div>
            @if(Auth::check())
            <br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_admin" name="is_admin" >
                <label class="form-check-label" for="is_admin">
                    Set As Admin?
                </label>
            </div>
            @endif
            <br><br>
            <button class="btn btn-primary" type="submit">@if(Auth::check())Add new User @else Sign Up @endif</button>
            @if(!Auth::check())
            <a href="{{URL('/user/')}}"> <span class="btn btn-primary">Have an account? -- Login</span></a>
            @endif

        </form>
    </div>
</div>
@endsection