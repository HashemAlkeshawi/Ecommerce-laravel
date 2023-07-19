@extends('mainTemplate')
@section('title')
<title>{{$d_user->first_name}}'s Profile</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 50;" class="container">
    <div class="page-header">
        <h1 class="header">{{$d_user->first_name}}'s Profile</h1>
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
        <a href="{{URL('d_user/'. $d_user->id)}}">
            <li class="list-group-item  well"><span class="text-primary">Name:</span> {{$d_user->first_name}} {{ $d_user->last_name}}</li>
        </a>
        <li class="list-group-item  well"><span class="text-primary">Email:</span> {{$d_user->email}}</li>
        <li class="list-group-item  well"><span class="text-primary">Account Status: </span>@if($d_user->is_active ==1) <span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</li>
        @if(isset($d_user->address))

        <li class="list-group-item  well"><span class="text-primary">Country: </span> {{$d_user->address->city->country->name}}
        </li>
        <li class="list-group-item  well"><span class="text-primary">City: </span> {{$d_user->address->city->name}}
        </li>
        <li class="list-group-item  well"><span class="text-primary">Street: </span> {{$d_user->address->street}}
        </li>
        <li class="list-group-item  well"><span class="text-primary">District: </span> {{$d_user->address->district}}
        </li>
        @else
        <li class="list-group-item well">
            <form method="GET" action="{{URL('address/create/')}}">
                <input type="hidden" name="addressable_id" value="{{$d_user->id}}">
                <input type="hidden" name="addressable_type" value="v">
                <button class="btn btn-primary" type="submit">Set Address</button>
            </form>
        </li>
        @endif

        <br>
        <div class="row">
            @if(isset($d_user->address))
            <div class="col-auto">
                <a href="{{URL('address/'.$d_user->address->id .'/edit')}}" class="btn btn-primary" name="edit">Edit Address</a>
            </div>
            @endif
            <div class="col-auto">
                <a href="{{URL('d_user/'.$d_user->id .'/edit')}}" class="btn btn-primary" name="edit">Edit</a>
            </div>
            <div class="col-auto">
                <form method="POST" action="{{URL('d_user/'.$d_user->id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" name="Delete" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </ul>
</div>
@endsection