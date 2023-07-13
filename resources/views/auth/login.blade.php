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
            <h1 class="header">Log In</h1>
        </div>
        <form method="POST" action="{{URL('d_user/authenticate')}}">
            @csrf


            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" id="email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
 

            <br><br>
            <button class="btn btn-primary" type="submit">Log In</button>
            <a href="{{URL('/d_user/register')}}"> <span class="btn btn-primary" >Sign Up</span></a>
        </form>
    </div>
</div>
@endsection