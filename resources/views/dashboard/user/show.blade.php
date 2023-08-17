@extends('mainTemplate')
@section('title')
<title>{{$user->first_name}}'s Profile</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 50;" class="container">
    <div class="page-header">
        <h1 class="header">{{$user->first_name}}'s Profile</h1>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif



    <ul class="list-group">
        <a href="{{URL('user/'. $user->id)}}">
            <li class="list-group-item  well"><span class="text-primary">Name:</span> {{$user->first_name}} {{ $user->last_name}}</li>
        </a>
        <li class="list-group-item  well"><span class="text-primary">Email:</span> {{$user->email}}</li>
        <li class="list-group-item  well"><span class="text-primary">Account Status: </span>@if($user->is_active ==1) <span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</li>
        @if(isset($user->address))

        <li class="list-group-item  well"><span class="text-primary">Country: </span> {{$user->address->city->country->name}}
        </li>
        <li class="list-group-item  well"><span class="text-primary">City: </span> {{$user->address->city->name}}
        </li>
        <li class="list-group-item  well"><span class="text-primary">Street: </span> {{$user->address->street}}
        </li>
        <li class="list-group-item  well"><span class="text-primary">District: </span> {{$user->address->district}}
        </li>
        @else
        <li class="list-group-item well">
            <form method="GET" action="{{URL('address/create/')}}">
                <input type="hidden" name="addressable_id" value="{{$user->id}}">
                <input type="hidden" name="addressable_type" value="u">
                <button class="btn btn-primary" type="submit">Set Address</button>
            </form>
        </li>
        @endif

        <br>
        <div class="row">
            @if(isset($user->address))
            <div class="col-auto">
                <a href="{{URL('address/'.$user->address->id .'/edit')}}" class="btn btn-primary" name="edit">Edit Address</a>
            </div>
            @endif
            <div class="col-auto">
                <a href="{{URL('user/'.$user->id .'/edit')}}" class="btn btn-primary" name="edit">Edit</a>
            </div>
            <div class="col-auto">
                <form method="POST" action="{{URL('user/'.$user->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" name="Delete" type="submit">Delete</button>
                </form>

            </div>
            <div class="col-auto">
                <a href="{{URL('user/'.$user->id .'/email')}}" class="btn btn-primary" name="edit">Send Email</a>
            </div>
        </div>
    </ul>
</div>
@endsection