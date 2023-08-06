@extends('mainTemplate')


@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">

    <h1 style="color: #333;">Password Reset</h1>

    <p>Hello <strong>{{ $username }}</strong>,</p>

    <p>You have requested to reset your password. Please use the following code to reset your password:</p>

    <p style="background-color: #f1f1f1; padding: 10px; font-size: 18px;"><strong>{{ $reset_code }}</strong></p>

    <p>If you did not initiate this request, you can safely ignore this email.</p>

    <p>Thank you,</p>
    <p>Apples Store Team</p>

</div>



@endsection