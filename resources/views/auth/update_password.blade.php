@extends('mainTemplate')
@section('title')
<title>Add new user</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')

<div style="margin-top: 100;" class="container">
@if (session('messages'))
  <div class="alert alert-danger">
    <ul>
      @foreach (session('messages') as $message)
      <li>{{ $message }}</li>
      @endforeach
    </ul>
  </div>
  @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-auto">
        <div class="page-header">
            <h1 class="header">Reset Password</h1>
        </div>
        <form method="POST" action="{{URL('user/update_password')}}">
            @csrf
            <input type="hidden" name="user_id" value="{{$user_reset_code->user_id}}">


            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <label>Check Password</label>
                <input class="form-control" type="password" name="check_password" id="check_password">
            </div>
<br>
            <button type="submit" class="btn btn-primary">Update Password</button>

        </form>
    </div>
</div>
@endsection