@extends('mainTemplate')
@section('title')
<title>Add new Item</title>
@endsection
@include('components\navBar')

@section('content')

<div style="margin-top: 100;" class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-12">
        <div class="page-header">
            <h1 class="header">Add New Item for {{$brand->name}}</h1>
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{URL('item')}}">
            @csrf
            <input name="brand_id" type="hidden" value="{{$brand->id}}">
            <div class="form-group">
                <label class="form-label">Item Name</label>
                <input class="form-control" type="text" name="name" placeholder="item name" id="name">
            </div>

            <div class="form-group">
                <label class="form-label">Price</label>
                <input class="form-control" name="price" type="number" , step="0.01">
            </div>

            <div class="form-group">
                <label class="form-label">Image</label>
                <input class="form-control" name="image" type="file">
            </div><br>

            <br>

            <button class="btn btn-primary" type="submit">Save</button>

        </form>
    </div>
</div>
@endsection