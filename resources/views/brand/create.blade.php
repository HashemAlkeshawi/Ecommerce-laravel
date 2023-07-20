@extends('mainTemplate')
@section('title')
<title>Add new Brad</title>
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
            <h1 class="header">Add New Brand</h1>
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{URL('brand')}}">
            @csrf
            <div class="form-group">
                <label class="form-label">Band Name</label>
                <input class="form-control" type="text" name="name" placeholder="brand name" id="name">
            </div>
            
            <div class="form-group">
                <label class="form-label">Notes</label>
                <textarea  class="form-control" name="notes" placeholder="brand notes"></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Icon</label>
                <input class="form-control" name="icon" type="file">
            </div>
<br>

            <button class="btn btn-primary" type="submit">Save</button>

        </form>
    </div>
</div>
@endsection