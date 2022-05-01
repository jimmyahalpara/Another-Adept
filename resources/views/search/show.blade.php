@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceSearch" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/background (2).jpg') }}'); background-position: 0% 65%">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0);">
                <h1 style="text-shadow: 0px 0px 13px white">{{ $service->name }}</h1>
                <h3 style="text-shadow: 0px 0px 13px white">{{ $service->organization->name }}</h3>
            </div>
        </div>
    </section>

    <main class="mx-4 mt-2 row">
        <div class="col-md-4">
            <div id="show-left-bar-container">
                <img id="show-service-image" src="{{ $service->images->first()->image_path }}" alt=""
                    class="mt-3">
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <div class="show-service-rating-container">
                        @if ($service_stat)
                            @php
                                $rating = $service_stat->average;
                            @endphp

                            @for ($i = 0; $i < (int) $rating; $i++)
                                <i class="text-warning fa-solid fa-star"></i>
                            @endfor
                            @if ($rating - (int) $rating != 0)
                                <i class="text-warning fa-solid fa-star-half"></i>
                            @endif
                            <span id="service-rating-number" class="ms-1">{{ $service_stat->count }}</span>
                            Ratings
                        @else
                            No Ratings Yet
                        @endif

                    </div>
                    <div class="show-service-like-container">
                        @if ($user && $user->services->contains($service->id))
                            <i id="like-button-{{ $service->id }}" class="cart-button ps-3 text-danger fa-solid fa-heart"
                                onclick="like_clicked({{ $service->id }})"></i>
                        @else
                            <i id="like-button-{{ $service->id }}"
                                class="cart-button ps-3 text-danger fa-regular fa-heart"
                                onclick="like_clicked({{ $service->id }})"></i>
                        @endif
                    </div>
                </div>
                <div class="mt-3">
                    @if ($service->areas->contains($user ? $user->area_id : 0))
                        <button class="btn btn-success w-100"
                            onclick="order('{{ route('order.place', ['service' => $service->id]) }}')">Order</button>
                    @else
                        <button class="btn btn-outline-secondary w-100"
                            onclick="order('{{ route('order.place', ['service' => $service->id]) }}', true)">Order</button>
                    @endif
                </div>
                <div class="mt-3 show-service-availablity">
                    @auth
                        @if ($service->areas->contains($user ? $user->area_id : 0))
                            <span class="text-success">
                                <i class="fa-solid fa-check"></i>
                                Available In Your Area
                            </span>
                        @else
                            <span class="text-danger">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                May Not be available in your area
                            </span>
                        @endif
                    @endauth
                    @guest
                        <div class="d-flex align-items-center">
                            <div>
                                <i class="fa-solid fa-location-crosshairs"></i>
                            </div>
                            <div class="ms-1">
                                <a class="link-heading" href="{{ route('login') }}">Login</a>
                                to know if this service is availble in your area or not.
                            </div>
                        </div>
                    @endguest

                </div>
                <div id="show-service-location" class="mt-3 show-service-location d-flex p-1 d-none d-md-inline-block">
                    <div>
                        <i class="fa-solid fa-location-dot"></i>
                        <h5 class="d-inline-block">Locations</h5>
                    </div>
                    <div class="mx-1">
                        <table class="table table-bordered" id="area-table">
                            <thead>
                                <tr>
                                    <th>City</th>
                                    <th>Area</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service->areas as $area)
                                    <tr>
                                        <td>{{ $area->city->name }}</td>
                                        <td>{{ $area->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @forelse ($service->areas as $area)
                            <span
                                class="badge @if ($area->id == ($user ? $user->area_id : 0)) bg-success @else bg-dark @endif ">{{ $area->city->name }}
                                - {{ $area->name }}</span>
                        @empty
                            <span class="badge bg-danger">
                                Not Available in Any Area
                            </span>
                        @endforelse --}}
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-8">
            @if (!$errors->isEmpty())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br>
                    @endforeach
                </div>
            @endif
            <h2>Description</h2>
            <p>
                {!! nl2br(e($service->description)) !!}
            </p>

            <div id="rating-container" class="p-2 w-100 d-flex justify-content-center align-items-center flex-column">
                <h5 class="m-2">We'd Like your feedback</h5>
                @auth
                    <div class="stars-container">

                        @if ($user && $current_user_rating)
                            @php
                                // dd($current_user_rating);
                                $rating = $current_user_rating->rating;
                                $count = 0;
                            @endphp

                            @for ($i = 0; $i < (int) $rating; $i++)
                                @php
                                    $count++;
                                @endphp
                                <i class="text-warning show-service-rating-star fa-solid fa-star"
                                    onclick="submitRating({{ $count }})"></i>
                            @endfor
                            @if ($rating - (int) $rating != 0)
                                @php
                                    $count++;
                                @endphp
                                <i class="text-warning show-service-rating-star fa-regular fa-star-half-stroke"
                                    onclick="submitRating({{ $count }})"></i>
                            @endif

                            @while ($count < 5)
                                @php
                                    $count++;
                                @endphp
                                <i class="fa-regular fa-star show-service-rating-star"
                                    onclick="submitRating({{ $count }})"></i>
                            @endwhile
                        @else
                            <i class="fa-regular fa-star show-service-rating-star" onclick="submitRating(1)"></i>
                            <i class="fa-regular fa-star show-service-rating-star" onclick="submitRating(2)"></i>
                            <i class="fa-regular fa-star show-service-rating-star" onclick="submitRating(3)"></i>
                            <i class="fa-regular fa-star show-service-rating-star" onclick="submitRating(4)"></i>
                            <i class="fa-regular fa-star show-service-rating-star" onclick="submitRating(5)"></i>
                        @endif
                    </div>
                @endauth
                @guest
                    <div class="btn-container">
                        <button class="buttonRounded-outlined-light px-4 p-2 m-2"
                            onclick="document.location='{{ route('login') }}'">
                            Login
                        </button>
                        <button class="buttonRounded-outlined-light px-4 p-2 m-2"
                            onclick="document.location='{{ route('register') }}'">
                            Sign Up
                        </button>
                    </div>
                @endguest
            </div>
            <div class="mt-3">
                <h2>Reviews</h2>
                <div class="filter-container">
                    Sort By:
                    <button class="btn btn-outline-secondary m-2"
                        onclick="updateRatings(1, 'updated_at', 'desc')">Latest</button>
                    <button class="btn btn-outline-secondary m-2"
                        onclick="updateRatings(1, 'rating', 'asc')">Critical</button>

                </div>
                <div id="review-container" class="review-container p-1">





                </div>
                <div class="p-1 pagination-container d-flex justify-content-center align-items-center">
                    <ul id="review-pagination" class="pagination">
                        {{-- <li class="page-item"><a class="page-link">Previous</a></li>
                        <li class="page-item"><a class="page-link">Next</a></li> --}}
                    </ul>
                </div>


            </div>
        </div>
    </main>

    {{-- RATING MODEL --}}
    <div id="ratingModel" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Rating</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="feedback-form" action="{{ route('services.rate', ['service' => $service->id]) }}"
                        method="post">
                        @csrf
                        <input id="rating-value" type="hidden" name="rating" value="0">
                        <textarea placeholder="Some Feedback (optional)(max: 1000 characters)" name="feedback" id="" cols="30" rows="10"
                            class="form-control"
                            maxlength="1000">{{ old('feedback', optional($current_user_rating ?? null)->feedback) }}</textarea>
                        <small class="small-note">Note: This feedback will be publically available</small>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#feedback-form').submit()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function like_clicked(service_id) {
            @auth
                @if ($user && $user->email_verified_at == null)
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



        function submitRating(number) {
            @auth
                @if ($user && $user->email_verified_at == null)
                    document.location='{{ route('verification.notice') }}'
                @else
                    console.log(number);
                    $('#rating-value').val(number)
                
                    var myModal = new bootstrap.Modal(document.getElementById('ratingModel'));
                    myModal.show(300);
                @endif
            @endauth
            @guest
                document.location='{{ route('login') }}';
            @endguest

        }


        function updateRatings(page = 1, sort = 'updated_at', direction = 'DESC') {
            var review_container = $('#review-container');
            var page_container = $('#review-pagination');
            $.get({
                url: '{{ route('service.rating') }}',
                data: {
                    service_id: {{ $service->id }},
                    page: page,
                    sort: sort,
                    direction: direction
                },
                success: function(response) {
                    console.log(response);
                    posts = response.data;

                    if (posts == null || posts.length == 0) {

                        review_container.html('NO REVIEWS FOUND');
                    } else {
                        review_container.html('');
                    }

                    posts.forEach(element => {
                        stars = '';

                        updated_at = element.updated_at;
                        date = updated_at.substring(0, 10);
                        time = updated_at.substring(12, 16);
                        for (let index = 0; index < element.rating; index++) {
                            stars += '<i class="fa-solid fa-star text-warning"></i>';
                        }

                        html = `
                        <div class="review-item my-3 p-2">
                            <div class="header d-flex justify-container-center align-items-center">
                                <div>
                                    <b>
                                        ` + element.user.name + `
                                    </b>
                                </div>
                                    
                                <div class="ms-1">
                                    ` + stars + `
                                </div>
                                <div class="ms-3">
                                    ` + time + ' ' + date + `
                                </div>
                            </div>
                            <div class="review-content">
                                ` + (element.feedback ? element.feedback : '') + `
                            </div>
                        </div>

                        `;

                        review_container.append(html);


                    });

                    prev_link = ''
                    if (response.prev_page_url == null) {
                        prev_link = 'disabled'
                    }

                    next_link = ''
                    if (response.next_page_url == null) {
                        next_link = 'disabled'
                    }

                    // console.log('prev',prev_link);
                    // console.log('next',next_link);

                    next_page_number = page + 1;
                    prev_page_number = page - 1;
                    paginator = `
                        <li class="page-item ` + prev_link + ` "><a class="page-link" onclick='updateRatings(` +
                        prev_page_number + `,"` + sort + `","` + direction + `")'>Previous</a></li>
                        <li class="page-item ` + next_link + `"><a class="page-link"  onclick='updateRatings(` +
                        next_page_number + `,"` + sort + `","` + direction + `")'>Next</a></li>
                    `;
                    page_container.html(paginator);



                },
                error: function(response) {
                    console.log(response);
                }
            })
        }
        updateRatings(1, 'id', 'DESC');

        // $('#show-service-location').readmore({
        //     speed: 75,
        //     collapsedHeight: 100,
        //     lessLink: '<a href="#">More Locations</a>'
        // });


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
    </script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#area-table').DataTable({
            pagingType: "full",
            columnDefs: [{
                orderable: false,
                targets: 0
            }]
        });




        $(document).ready(function() {
            $('.dataTables_filter input[type="search"]').css({
                'width': '100px',
                'display': 'inline-block'
            });
        });
    </script>
@endsection
