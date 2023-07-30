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
        <h1 class="header">All Users</h1>
    </div>
    <form method="GET" action="{{URL('/user')}}">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <label for="filter_by1">Search by email</label>
                    <input class="form-control" type="email" placeholder="email" name="EmailFilter" @if(@isset($filters)) value="{{$filters->EmailFilter}}" @endif>

                </li>
                <li class="list-group-item">
                    <label for="filter_by2">Search by username</label>
                    <input class="form-control" type="string" placeholder="username" name="UsernameFilter" @if(@isset($filters)) value="{{$filters->UsernameFilter}}" @endif>

                </li>
                <li class="list-group-item">
                    <label for="filter_by3">Search by name</label>
                    <input class="form-control" type="string" placeholder="full name" name="NameFilter" @if(@isset($filters) ) value="{{$filters->NameFilter}}" @endif>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label for="country">Search by country:</label>
                        <select class="form-select" aria-label="Default select example" name="AddressCountryFilter" id="country">

                            <option value='' @if(!@isset($filters->AddressCountryFilter) ) selected @endif>Country..</option>

                            @foreach($countries as $country)
                            <option value="{{ $country->id}}" @if(@isset($filters->AddressCountryFilter) && $filters->AddressCountryFilter == $country->id ) selected @endif>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>

            </ul>
        </div>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="search_is_active" name="ActivationFilter" value="1" @if(@isset($filters) && $filters->ActivationFilter == '1')checked @endif>
            <label class="form-check-label">Active Users Only</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="search_is_admin" name="AdministrationFilter" value="1" @if(@isset($filters) && $filters->AdministrationFilter == '1 ')checked @endif>
            <label class="form-check-label">Admins Only</label>
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Apply filters</button>
        <a href="{{URL('user/')}}" class="btn btn-danger">Remove filters</a>
        <br>
        <br>

    </form>
    <h6 class="well well-lg">Loged in user id: {{Auth::user()->id}}</h6>
    <h6 class="well well-lg">Loged in username: {{Auth::user()->username}}</h6><br>
    @if(@isset($users) && ! $users->isEmpty())
    <ul class="list-group">
        @foreach($users as $user)
        <a href="{{URL('user/'. $user->id)}}">
            <li class="list-group-item  well"><span class="text-primary">Name:</span> {{$user->first_name}} {{ $user->last_name}}</li>
        </a>
        <li class="list-group-item  well"><span class="text-primary">email:</span> {{$user->email}}</li>
        <li class="list-group-item  well"><span class="text-primary">User Status 'Admin/User':</span> @if($user->is_admin ==1) Admin @else User @endif</li>
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

        @endif

        <br>
        <div class="row">
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
        </div>
        <hr>
        @endforeach
    </ul>
    <div>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
    @else
    <div class="alert alert-danger">
        <p>No useres found!</p>
    </div>

    @endif

</div>
@endsection