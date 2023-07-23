@extends('mainTemplate')
@section('title')
<title>{{$item->name}}</title>
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

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <img class="card-img-top" src="{{$item->image}}" alt="Card image cap" id="itemImage">
                <div class="card-body">
                    <a href="{{URL('item')}}" class="link-dark">
                        <h5 id="itemName" class="card-title"> {{$item->name}}</h5>
                    </a>
                    <h5 id="brandName" class="card-title">Brand: {{$item->brand->name}}</h5>

                    @if(Auth::user()->isAdmin())
                    <div class="row ">
                        <div class="col-auto" style="margin-left: 10px;">
                            <a href="{{URL('item/'.$item->id .'/edit')}}" class="btn btn-primary" name="edit">Edit</a>
                        </div>
                        <div class="col-auto">
                            <form method="POST" action="{{URL('item/'.$item->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" name="Delete" type="submit">Delete</button>
                            </form>
                        </div>
                        <div class="col-auto">
                            @if($item->isActive())
                            <div class="d-inline-flex align-items-center">
                                <div class="rounded-circle bg-success" style="width: 30px; height: 30px; margin:8px;"></div>
                                <span class="status-text">Active</span>
                            </div>
                            @else
                            <div class="d-inline-flex align-items-center">
                                <div class="rounded-circle bg-danger" style="width: 30px; height: 30px;  margin:8px;"></div>
                                <span class="status-text">Inactive</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('components\include\editItemCardLogic')
@endsection