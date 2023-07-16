@extends('mainTemplate')
@section('title')
<title>Dashboard</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div class="container">
    <h1>Welcom {{Auth::user()->first_name}}, your ID is: {{Auth::user()->id}}</h1>
</div>
@endsection