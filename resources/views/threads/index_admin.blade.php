@extends('voyager::master')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    @include('threads.partials.index')
@endsection
