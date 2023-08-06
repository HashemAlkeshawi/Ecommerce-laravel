@extends('mainTemplate')
@section('title')
<title>Add new user</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')

<div style="margin-top: 50;" class="container">
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
            <h1 class="header">Enter Reset Code</h1>
        </div>
        <p>We have send you a five digits code, check your mail box...</p>
        <form method="POST" action="{{URL('user/reset_password')}}">
            @csrf

            <input type="hidden" name="user_id" value="{{$user_id}}">
            <div class="form-group">
                <label>Enter The code:</label>
                <input class="form-control" type="text" name="reset_code" placeholder="" id="email">
            </div>
            <br>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Continue to change password</button>
            </div>

        </form>
    </div>
</div>
@endsection