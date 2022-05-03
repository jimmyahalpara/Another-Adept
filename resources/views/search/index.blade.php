@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceSearch" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/background (2).jpg') }}'); background-position: 0% 65%">
            <div class="mask d-flex justify-content-center align-items-center flex-column" style="">
                <h1 style="text-shadow: 0px 0px 13px white">Services</h1>

            </div>
        </div>
    </section>
    <main class="p-3">
        <div class="row">
            <div class="col-md-7">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary m-1 secondary dropdown-toggle" type="button"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort By
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li class="dropdown-links">
                            @sortablelink('name')
                        </li>
                        <li class="dropdown-links">
                            @sortablelink('price')
                        </li>
                        <li class="dropdown-links">
                            @sortablelink('created_at', 'Created At')
                        </li>
                        <li class="dropdown-links">
                            @sortablelink('organization.name', 'Organization Name')
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5 row m-0 align-items-center">
                <div class="col-8 col-md-6 col-lg-9 d-flex justify-content-center align-items-center">
                    <input placeholder="Search .. " type="search" name="search_text" id="query" class="form-control"
                        form="filterForm" value="{{ $search_text }}">
                </div>
                <button class="btn btn-primary px-1 col-4 col-md-6 col-lg-3"
                    onclick="$('#filterForm').submit()">Search</button>

            </div>
        </div>
        <div class="m-1 row">
            <div class="col-lg-2">
                <div id="collapseForm">
                    <h4>Filters</h4>
                    <form id="filterForm" action="" class="m-1">
                        <input type="hidden" name="num_rows" value="{{ $num_rows }}">

                        {{-- Price range --}}
                        <div class="form-group">
                            <label>Price Range</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="number" class="form-control d-inlin-block" name="min_price" id="min_price"
                                        placeholder="MIN" value="{{ $min_price }}">
                                </div>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control d-inlin-block" name="max_price" id="max_price"
                                        placeholder="MAX" value="{{ $max_price }}">
                                </div>
                            </div>
                        </div>
                        {{-- Price Type --}}
                        <div class="form-group">
                            <label for="price_type">Select Price Types</label><br>
                            <select id="price_type" class="js-example-basic-multiple" name="price_types_filter[]"
                                multiple="multiple">
                                @foreach ($price_types as $price_type)
                                    <option value="{{ $price_type->id }}"
                                        @if (in_array($price_type->id, $price_types_filter)) selected @endif>
                                        {{ $price_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Areas --}}
                        <div class="form-group">
                            <label for="state_id">Select State</label><br>
                            <select id="state_id" name="state_filter" class="form-control">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->state }}" @if ($state->state == $state_filter) selected @endif>
                                        {{ $state->state }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city_id">Select Cities</label><br>
                            <select id="city_id" name="city_filter" class="form-control">
                                <option value="">Select City</option>
                                @php
                                    $current_state_cities = \App\Models\City::where('state', $state_filter)
                                        ->orderBy('name')
                                        ->get();
                                @endphp
                                @if ($current_state_cities->count() > 0)
                                    @foreach ($current_state_cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if ($city_filter == $city->id) selected @endif>{{ $city->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="area">Select Areas</label><br>
                            <select id="area_id" class="js-example-basic-multiple" name="areas[]" multiple="multiple">
                                @php
                                    $current_city_areas = \App\Models\Area::where('city_id', $city_filter)->get();
                                @endphp
                                @foreach ($current_city_areas as $area)
                                    <option value="{{ $area->id }}" @if (in_array($area->id, $areas)) selected @endif>
                                        {{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Categories --}}
                        <div class="form-group">
                            <label for="category">Select Categories</label><br>
                            <select id="category" class="js-example-basic-multiple" name="categories_filter[]"
                                multiple="multiple">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if (in_array($category->id, $categories_filter)) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SELECT ORGANIZATIONS --}}
                        <div class="form-group">
                            <label for="organization">Select Organization</label><br>
                            <select id="organization" class="js-example-basic-multiple" name="organization_filter[]"
                                multiple="multiple">
                                @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}"
                                        @if (in_array($organization->id, $organization_filter)) selected @endif>
                                        {{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="button-container d-flex justify-content-center align-items-center flex-column">
                            <button class="btn btn-secondary my-1 w-50" type="submit">Filter</button>
                            <a class="link-heading" href="{{ route('search') }}">Reset Filters</a>
                        </div>




                    </form>
                </div>
            </div>
            <div class="col-lg-10 p-1">
                @forelse ($services as $service)
                    @include('search.partials.service')
                @empty
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center flex-column">
                        <img id="no-result-image" src="{{ asset('assets/images/noresult.gif') }}" alt="No Result">
                        <div id="no-result-text" class="d-flex justify-content-center align-items-center flex-column">
                            <h1>No Results Found</h1>
                            <a href="{{ route('search') }}" class="link-heading">
                                Want to try resetting filters ?
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="m-1 d-flex justify-content-center align-items-center">
                {{ $services->links() }}
            </div>
        </div>


    </main>



    <script>
        $("#num_rows").on('change', function(e) {
            value = this.value;

            url = new URL(window.location.href);
            url.searchParams.set('num_rows', value);
            url.searchParams.set('page', 1);
            document.location = url.href;
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });


        function like_clicked(service_id, notify_later = false) {
            @auth
                @if ($user = Auth::user() && $user->email_verified_at == null)
                    document.location='{{ route('verification.notice') }}'
                @else
                    $element = $('#like-button-' + service_id);
                
                    if ($element.hasClass('fa-regular')){
                    // code to like this service
                    $.post({
                    url: '{{ route('services.like-dislike') }}',
                    data: {
                    id: service_id,
                    action: 1
                    },
                    success: function (response) {
                    console.log(response);
                
                    $element.removeClass('fa-regular');
                    $element.addClass('fa-solid');
                
                
                    $user_like_icon = $('#user-like-icon');
                    $user_like_number = $('#user-like-number');
                
                
                    $user_like_icon.removeClass('fa-regular');
                    $user_like_icon.removeClass('fa-solid');
                    $user_like_icon.addClass('fa-solid');
                    $user_like_icon.addClass('text-danger');
                    $user_like_number.html(response);
                
                    if (notify_later){
                    likedSuccessFullyWithNotification();
                    } else {
                    likedSuccessFully();
                    }
                
                    },
                    error: function (response) {
                    console.log(response);
                    }
                    });
                    } else {
                    // code to dislike this service
                    $.post({
                    url: '{{ route('services.like-dislike') }}',
                    data: {
                    id: service_id,
                    action: 0
                    },
                    success: function (response) {
                    console.log(response);
                
                    $element.removeClass('fa-solid');
                    $element.addClass('fa-regular');
                
                    $user_like_icon = $('#user-like-icon');
                    $user_like_number = $('#user-like-number');
                
                
                    if (response <= 0){ $user_like_number.html(''); $user_like_icon.removeClass('fa-solid');
                        $user_like_icon.removeClass('fa-regular'); $user_like_icon.removeClass('text-danger');
                        $user_like_icon.addClass('fa-regular'); } else { $user_like_number.html(response); } }, error: function
                        (response) { console.log(response); } }); } @endif
            @endauth
            @guest
                document.location='{{ route('login') }}';
            @endguest

        }

        function likedSuccessFully() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'Service Liked. You can view it later.'
            });
        }


        function likedSuccessFullyWithNotification() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'Service Liked. We will let you know when this service is available in your area.'
            });
        }


        function order(url, show_warning = false) {
            if (show_warning) {
                Swal.fire({
                    title: 'This service is not available in your service. ',
                    confirmButtonText: 'Order',
                    denyButtonText: `Don't save`,
                    icon: 'warning'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location = url;
                    }
                })
            } else {
                document.location = url;
            }
        }



        items = $('.dropdown-links');
        $.each(items, function(e, element) {
            element = $(element);
            child = element.find('a');
            child.addClass('d-flex');
            child.addClass('justify-content-between');
            child.addClass('align-items-center');
            child.addClass('dropdown-item');
            child2 = element.find('i');
            child2.addClass('m-1')
            child2.detach().appendTo(child);
        });


        $(document).ready(function(e) {
            $('body').on('change', '#state_id', function(e) {
                $state = $(this).val();

                $.ajax({
                    url: "{{ route('get.cities') }}",
                    type: "GET",
                    data: {
                        state: $state
                    },
                    success: function(json) {
                        $('#city_id').html('<option value="">Select City</option>');
                        json.forEach(element => {
                            $('#city_id').append(
                                `<option value="${element.id}">${element.name}</option>`
                            );
                        });
                    }
                });
            });

            $('body').on('change', '#city_id', function(e) {
                $city_id = $(this).val();

                $.ajax({
                    url: "{{ route('get.areas') }}",
                    type: "GET",
                    data: {
                        city_id: $city_id
                    },
                    success: function(json) {
                        $('#area_id').html('');
                        json.forEach(element => {
                            $('#area_id').append(
                                `<option value="${element.id}">${element.name}</option>`
                            );
                        });
                    }
                });
            });
        });
    </script>
@endsection
