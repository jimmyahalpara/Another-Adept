@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/background (1).jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(26, 27, 41, 0);">
                <h1 style="padding: 10px 10px; color: white; text-shadow: 0px 0px 5px black">Our Team</h1>
            </div>
        </div>
    </section>
    <main class="p-md-3 px-md-5 d-flex justify-content-center align-items-center flex-wrap">

        <div class="team-profile-card">
            <img class="team-profile-image" src="{{ asset('assets/images/avatar_default.png') }}" alt="">
            <div class="p-2 d-flex justify-content-center align-items-center flex-column">
                <h4>Dhruval Bhuva</h4>
                <h6>Rajkot</h6>
                <div class="team-info p-1 mt-2">
                    Worked as a Team Leader building this project, designing database. Helped Us with his great ideas, which made this project a success.
                </div>
            </div>
        </div>
        <div class="team-profile-card">
            <img class="team-profile-image" src="{{ asset('assets/images/avatar_default.png') }}" alt="">
            <div class="p-2 d-flex justify-content-center align-items-center flex-column">
                <h4>Milan Vaishnav</h4>
                <h6>Rajkot</h6>
                <div class="team-info p-1 mt-2">
                    Designed all the Aewsome things that you see in this site, without him, this side would have look like a site in 90s
                </div>
            </div>
        </div>
        <div class="team-profile-card">
            <img class="team-profile-image" src="{{ asset('assets/images/avatar_default.png') }}" alt="">
            <div class="p-2 d-flex justify-content-center align-items-center flex-column">
                <h4>Jimmy Ahalpara</h4>
                <h6>Bhavnagar</h6>
                <div class="team-info p-1 mt-2">
                    Developed the backend of this site, if you see any bugs, please let him know, he will fix it.😉
                </div>
            </div>
        </div>
        <div class="team-profile-card">
            <img class="team-profile-image" src="{{ asset('assets/images/avatar_default.png') }}" alt="">
            <div class="p-2 d-flex justify-content-center align-items-center flex-column">
                <h4>Nirmal Juneja</h4>
                <h6>Porbandar</h6>
                <div class="team-info p-1 mt-2">
                    Because of his sharp eyes, not a single bug can escape production. Worked as a tester, helped enormouly to improve overall quality of the site. He was also responsible for documentation.
                </div>
            </div>
        </div>


        <div class="team-summary">
            We connect people to doorstep service providers. Service Adept is a platform where they can host their business, and make it truly digital. Connect with Service Adept, and get your service quality talking to the world.
        </div>

    </main>
@endsection
