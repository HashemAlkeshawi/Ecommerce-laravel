@extends('mainTemplate')
@section('title')
<title>Add new user</title>
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
            <h1 class="header">Log In</h1>
        </div>
        <form method="POST" action="{{URL('user/authenticate')}}">
            @csrf


            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="remember_me" name="remember_me">
                <label class="form-check-label" for="remember_me">
                    Remember Me
                </label>
            </div>
            <br>
            <a href="{{URL('/user/reset_password')}}"> <span>Forget password?</span></a>


            <br><br>
            <button class="btn btn-primary" type="submit">Log In</button>

            <a href="{{URL('/user/create')}}"> <span class="btn btn-primary">Sign Up</span></a>

        </form>
    </div>
</div>
@endsection