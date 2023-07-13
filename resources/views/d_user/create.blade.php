@extends('mainTemplate')
@section('title')
<title>Add new d_user</title>
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
            <h1 class="header">Add New d_user</h1>
        </div>
        <form method="POST" action="{{URL('/d_user')}}">
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
            <br><br>
            <button class="btn btn-primary" type="submit">Sign Up</button>
            <a href="{{URL('/d_user/')}}"> <span class="btn btn-primary" >Have an account? -- Login</span></a>

        </form>
    </div>
</div>
@endsection