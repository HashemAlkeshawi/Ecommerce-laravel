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
        <form method="POST" action="{{URL('user/set_reset_code')}}">
            @csrf


            <div class="form-group">
                <label>Enter your email:</label>
                <input class="form-control" type="email" name="email" placeholder="email.."  id="email">
            </div>
            <br>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Send Email</button>
            </div>

        </form>
    </div>
</div>
@endsection