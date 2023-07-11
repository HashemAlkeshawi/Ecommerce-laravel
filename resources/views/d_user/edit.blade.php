@extends('mainTemplate')
@section('title')
<title>Edit d_user</title>
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
            <h1 class="header">Edit d_user</h1>
        </div>
        <form method="POST" action="{{URL('d_user/'. $d_user->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Username</label>
                <input class="form-control" type="text" name="username" id="username" value="{{$d_user->username}}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" id="email" value="{{$d_user->email}}">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" id="password" value="{{$d_user->password}}">
            </div>

            <div class="form-group">
                <label class="form-label">First name</label>
                <input class="form-control" type="text" name="first_name" id="first_name" value="{{$d_user->first_name}}">
            </div>
            <div class="form-group">
                <label class="form-label">Last name</label>
                <input class="form-control" type="text" name="last_name" id="last_name" value="{{$d_user->last_name}}">
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin" value="1" @if($d_user->is_admin) checked @endif>
                <label class="form-check-label">Admin</label>
            </div>
            <br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1">
                <label class="form-check-label">Deactivate User?</label>
            </div>




            <br><br>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>
</div>
@endsection