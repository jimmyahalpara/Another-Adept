@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceOrders" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/background (4).jpg') }}'); background-position: 0% 80%">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0);">
                <h1>Help Center</h1>
            </div>
        </div>
    </section>
    @include('threads.partials.index')
@endsection
