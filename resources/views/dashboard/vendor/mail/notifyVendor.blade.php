@extends('mainTemplate')


@section('content')
<div style="margin-top: 10px;" class="container">
    <div class="col-12">
        <div class="page-header">
            <h5 class="header">Dear {{$vendor_name}}</h5>
        </div>
        <p class="lead">I hope this email finds you well. I am writing to bring to your attention an urgent matter regarding the inventory of {{$item->name}} at our warehouse.</p>
        <br>
        <p>
            As of {{date("Y-m-d h:m: a")}}, our current stock of {{$item->name}} has dropped significantly. This level is below our usual inventory threshold and may potentially lead to operational disruptions and unfulfilled customer orders.
        </p>
        <br>
        <p>We kindly request your immediate assistance in replenishing our stock. If possible, please confirm the availability of {{$item->name}} and provide an estimated delivery date. Your prompt action in this matter will be highly appreciated.</p>
        <br>
        <p>Item details:</p>
        <div class="card" style="width: 18rem;">
            <img>

            <div class="card-body">
                <h5 class="card-title">{{$item->name}}</h5>
                <h5 class="card-title">Price: {{$item->price}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$item->brand->name}}</h6>
            </div>
        </div>
    </div>
</div>



@endsection