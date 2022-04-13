@extends('mails.master')



@section('heading')
    Welcome {{ $user_name }} to Service Adept. 
@endsection



@section('content')
    <p>Thank You for Signing Up. All the services that you need to one place.</p>
    <button class="btn btn-success">Click to Get Started</button>
@endsection