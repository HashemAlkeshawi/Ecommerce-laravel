@extends('mainTemplate')
@section('title')
<title>Home</title>
@endsection
@section('content')
<div style="margin-top: 50;" class="container">
    <div class="page-header">
        <h1 class="header">Home page</h1>
    </div>


    <h2 class="well well-lg">All Users</h2>
    <ul class="list-group">
        @if($d_users)
        @foreach($d_users as $d_user)
      
        <li class="list-group-item  well"><span class="text-primary">email:</span> {{$d_user->email}}</li>
        <li class="list-group-item  well"><span class="text-primary">User Status 'Admin/User':</span> @if($d_user->is_admin ==1) Admin @else User @endif</li>
        <li class="list-group-item  well"><span class="text-primary">Account Status: </span>@if($d_user->is_active ==1) <span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</li>

        <div class="row">
            <div class="col-1 m-2">
              
            </div>
            <div class="col-1 m-2">
                <form method="POST" action="{{URL('d_user/'. $d_user->id)}}">
                    @csrf
                    @method('DELETE')
                    <input name="d_user_id" type="hidden" value="{{$d_user->id}}">
                    <button class="btn btn-danger" name="Delete" type="submit">Delete</button>
                </form>
                <form method="GET" action="{{URL('d_user/'. $d_user->id .'/edit')}}">
                    @csrf
                    <input name="d_user_id" type="hidden" value="{{$d_user->id}}">
                    <button class="btn btn-primary" name="Delete" type="submit">Edit</button>
                </form>

            </div>
        </div>
        <hr>
        @endforeach
        @endif
    </ul>
 
</div>
@endsection