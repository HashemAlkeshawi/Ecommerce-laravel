@extends('mainTemplate')
@section('title')
<title>Edit "{{$brand->name}}"" Brand</title>
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
                <img class="card-img-top"  width="100" height="220" src="{{$brand->icon}}" alt="Card image cap" id="brandImage">
                <div class="card-body">
                    <a href="{{URL('item')}}" class="link-dark">
                        <h5 id="brandName" class="card-title">{{$brand->name}}</h5>
                    </a>
                    <p id="brandNotes" class="card-text">{{$brand->notes}}</p>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="page-header">
                <h1 class="header">Edit '{{$brand->name}}' Brand</h1>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{URL('brand/'.$brand->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Band Name</label>
                    <input class="form-control" type="text" name="name" placeholder="brand name" id="name" value="{{$brand->name}}">
                </div>

                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control" name="notes" placeholder="brand notes">{{$brand->notes}}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Icon</label>
                    <input class="form-control" name="icon" type="file" id="iconInput">
                </div>
                <br>

                <button class="btn btn-primary" type="submit">Save Edits</button>

            </form>
        </div>
    </div>
</div>
@include('components\include\editBrandCardLogic')
@endsection