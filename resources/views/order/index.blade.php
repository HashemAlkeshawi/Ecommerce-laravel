@extends('mainTemplate')
@section('title')
<title>History</title>
@endsection
@section('navbar')
@include('components\navBar')
@endsection
@section('content')
<div style="margin-top: 20;" class="container">
  <div class="page-header">
    <h1 class="header">Your Purchases History</h1>
  </div>
  @if (session('messages'))
  <div class="alert alert-success">
    <ul>
      @foreach (session('messages') as $message)
      <li>{{ $message }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif


  @if(@isset($orders) && ! $orders->isEmpty())
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Item Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Total Price</th>
        <th scope="col">Order Status</th>
        <th scope="col">Order Date</th>
        <th scope="col">Delivery Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
        <th scope="row">{{$order->item->name}}</th>
        <td>{{$order->quantity}}</td>
        <td>{{$order->item->price}}</td>
        <td>{{$order->quantity * $order->item->price}}</td>
        @if($order->status == 1)
        <td class="text-success">delivered</td>
        @else
        <td>in-progress</td>

        @endif
        <td>{{$order->created_at}}</td>
        <td>{{$order->updated_at == $order->created_at? '-' : $order->updated_at}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div>
    {{ $orders->links('pagination::bootstrap-4') }}
  </div>
  @else
  <div class="alert alert-danger">
    <p>No History found!</p>
  </div>

  @endif

</div>

@endsection