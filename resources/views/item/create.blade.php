@extends('mainTemplate')
@section('title')
<title>Add new Item</title>
@endsection
@include('components\navBar')

@section('content')

<div style="margin-top: 10;" class="container">
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
            <h1 class="header">Add New Item</h1>
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{URL('item')}}">
            @csrf
            <div class="form-group">
                <label class="form-label">Item Name</label>
                <input class="form-control" type="text" name="name" placeholder="item name" id="name">
            </div>

            <div class="form-group">
                <label for="country">Select Brand:</label>
                <select class="form-select" aria-label="Default select example" name="brand_id" id="brand_id">
                    <option selected>Brand..</option>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id}}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            

            <div class="form-group">
                <label class="form-label">Price</label>
                <input class="form-control" name="price" type="number">
            </div>
            <div class="form-group">
                <label class="form-label">Image</label>
                <input class="form-control" name="image" type="file">
            </div>
            
        <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active">
                <label class="form-check-label" for="is_active">
                    Active Item?
                </label>
            </div>
            <br>

            <button class="btn btn-primary" type="submit">Save</button>

        </form>
    </div>
</div>
@endsection