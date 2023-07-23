@extends('mainTemplate')
@section('title')
<title>home</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div class="container">
    @if(Auth::check())
    <h1>Welcom {{Auth::user()->first_name}}</h1>
    @else
    <h1>Welcom, Sign in to browes out Store</h1>
    @endif
</div>
@endsection