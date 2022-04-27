@extends('voyager::master')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @include('threads.partials.thread');

    <style>
        .card-header {
            padding: 2vh 2vw
        }

        .card-footer .row {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2vh 2vw;   
        }
    </style>
@endsection
