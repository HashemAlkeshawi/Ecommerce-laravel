@extends('mainTemplate')
@section('title')
<title>Edit "{{$item->name}}"" Item</title>
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
    <div class="row">
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" width="100" height="220" src="{{$item->image}}" alt="Card image cap" id="itemImage">
                <div class="card-body">
                    <a href="{{URL('item')}}" class="link-dark">
                        <h5 id="itemName" class="card-title">{{$item->name}}</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="page-header">
                <h1 class="header">Edit '{{$item->name}}' Item</h1>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{URL('item/'.$item->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Item Name</label>
                    <input class="form-control" type="text" name="name" placeholder="item name" id="name" value="{{$item->name}}">
                </div>

                <div class="form-group">
                    <label for="country">Brands:</label>
                    <select class="form-select" aria-label="Default select example" name="brand_id" id="brand">

                        @foreach($brands as $brand)
                        <option value="{{ $brand->id}}" @if($brand->id == $item->brand_id) selected @endif>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                <label class="form-label">Price</label>
                <input class="form-control" name="price" type="number", step="0.01" value="{{$item->price}}">
            </div>
                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input class="form-control" name="image" type="file" id="imageInput">
                </div>
                <br>
                


                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="purchasable" name="purchasable" @if($item->purchasable ==1) checked @endif>
                    <label class="form-check-label" for="is_active">
                    purchasable item?
                    </label>
                </div>
                <br>

                <button class="btn btn-primary" type="submit">Save Edits</button>

            </form>
        </div>
    </div>
</div>
@include('components\include\editItemCardLogic')
@endsection