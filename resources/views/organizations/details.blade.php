@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>{{ $organization->name }}</h1>
            </div>
        </div>
    </section>
    <main class="p-3 px-5 d-flex justify-content-center align-items-center flex-column">
        @if (!$errors->isEmpty())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span><br>
                @endforeach
            </div>
        @endif
        <table class="table w-75">
            <tr>
                <th>Name</th>
                <td>{{ $organization->name }}</td>

            </tr>
            <tr>
                <th>Description</th>
                <td>{!! nl2br(e($organization->description)) !!}</td>

            </tr>
            <tr>
                <th>
                    Organization Admins
                </th>
                <td>
                    @foreach ($organization_admins as $admins)
                        {{-- @dump($admins -> organization_roles); --}}
                        @if ($admins->organization_roles[0]->id == 1)
                            <table class='table'>
                                <tr>
                                    <th>
                                        {{ $admins->user->name }}
                                    </th>
                                    <td>
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    {{ $admins->user->email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    {{ $admins->user->address }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>

        <h2>Services</h2>
        <div class="services-container w-100 p-2 m-2 d-flex justify-content-center align-items-center flex-wrap">
            @forelse ($services as $service)
                @php
                    if ($service->user_service_ratings_stat()) {
                        $service_stat = $service->user_service_ratings_stat();
                    }
                @endphp
                <div class="org-detail-tile border">
                    <div class="image">
                        <img src="{{ $service->images->first()->image_path }}" alt="">
                    </div>
                    <div class="p-2">
                        <h6>
                            <b>
                                <a href="{{ route('search.show', ['service' => $service->id]) }}"
                                    class="link-heading stretched-link">
                                    {{ $service->name }}
                                </a>
                            </b>
                        </h6>
                        @if ($service->user_service_ratings_stat())
                            @php
                                $stat = $service->user_service_ratings_stat();
                                $rating = $stat->average;
                            @endphp

                            @for ($i = 0; $i < (int) $rating; $i++)
                                <i class="text-warning fa-solid fa-star"></i>
                            @endfor
                            @if ($rating - (int) $rating != 0)
                                <i class="text-warning fa-solid fa-star-half"></i>
                            @endif
                            <span class="mx-1">(
                                <i class="fa-solid fa-user"></i>
                                {{ $stat->count }}
                                )</span>
                        @else
                            No Ratings
                        @endif
                    </div>
                </div>
            @empty
                <span class="p-1 m-1">
                    No Services Yet
                </span>
            @endforelse
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <button onclick="document.location='{{ route('search', ['organization_filter' => [$organization->id]]) }}'"
                class="buttonRounded-outlined-light px-3 py-2 m-1">
                View More
            </button>
            <button onclick="document.location='{{ route('organizations.index') }}'"
                class="buttonRounded-outlined-light px-3 py-2 m-1">
                Back
            </button>
        </div>

    </main>


@endsection
