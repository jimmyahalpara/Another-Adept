@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="
                                                                                                        background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="">
                
                    <h1>Sorry But We Cannot find the Page that You are looking for</h1>
                    <h5>ERROR: <span class="text-danger">404</span> </h5>

                    <form id="organization-form-container" class="w-75 mt-3 p-5 d-flex justify-content-center align-items-center flex-column" action="" method="get">
                        <h3>Search for Other Services</h3>
                        <input type="search" name="query" id="query" class="form-control" placeholder="Search Text ..">
                        <button class="m-2 px-4 py-2 buttonRounded-organization" type="submit">Search</button>
                    </form>
            </div>
        </div>
    </section>
@endsection
