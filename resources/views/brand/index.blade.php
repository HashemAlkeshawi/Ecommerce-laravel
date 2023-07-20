@extends('mainTemplate')
@section('title')
<title>Home</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 10;" class="container">
    <div class="page-header">
        <h1 class="header">Brands</h1>
    </div>
    <div class="row">
        @foreach($brands as $brand)
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{$brand->icon}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$brand->name}}</h5>
                    <p class="card-text">{{$brand->notes}}</p>
                    <a href="{{URL('item')}}" class="btn btn-primary">Show Items</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection