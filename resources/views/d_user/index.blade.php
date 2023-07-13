@extends('mainTemplate')
@section('title')
<title>Home</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 50;" class="container">
    <div class="page-header">
        <h1 class="header">Home page</h1>
    </div>


    <h3 class="well well-lg">All Users</h3><br>
    <h6 class="well well-lg">Loged in user id: {{Auth::user()->id}}</h6>
    <h6 class="well well-lg">Loged in username: {{Auth::user()->username}}</h6><br>
    @if($d_users)
    <ul class="list-group">
        @foreach($d_users as $d_user)

        <li class="list-group-item  well"><span class="text-primary">email:</span> {{$d_user->email}}</li>
        <li class="list-group-item  well"><span class="text-primary">User Status 'Admin/User':</span> @if($d_user->is_admin ==1) Admin @else User @endif</li>
        <li class="list-group-item  well"><span class="text-primary">Account Status: </span>@if($d_user->is_active ==1) <span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</li>

        <div class="row">
            <div class="col-1 m-2">

            </div>
            <div class="col-1 m-2">
                <form method="POST" action="{{URL('d_user/'.$d_user->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" name="Delete" type="submit">Delete</button>
                </form>
                <form method="GET" action="{{URL('d_user/'.$d_user->id .'/edit')}}">
                    @csrf
                    <button class="btn btn-primary" name="edit" type="submit">Edit</button>
                </form>

            </div>
        </div>
        <hr>
        @endforeach
    </ul>
    <div>
        {{ $d_users->links('pagination::bootstrap-4') }}
    </div>
    @endif

</div>
@endsection