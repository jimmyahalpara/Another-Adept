@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceSearch" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>{{ $service->name }}</h1>
                <h3>{{ $user->get_organization()->name }}</h3>
            </div>
        </div>
    </section>

    <main class="border mx-4 mt-2 row">
        <div class="col-md-4 border">
            <div id="show-left-bar-container">
                <img id="show-service-image" src="{{ $service->images->first()->image_path }}" alt="">
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <div class="show-service-rating-container">
                        @php
                            $rating = 3.5;
                        @endphp

                        @for ($i = 0; $i < (int) $rating; $i++)
                            <i class="text-warning fa-solid fa-star"></i>
                        @endfor
                        @if ($rating - (int) $rating != 0)
                            <i class="text-warning fa-solid fa-star-half"></i>
                        @endif
                        <span id="service-rating-number">239</span> Ratings
                    </div>
                    <div class="show-service-like-container">
                        @if ($user->services->contains($service->id))
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
                        <button class="btn btn-success w-100">Order</button>
                    @else
                        <button class="btn btn-outline-secondary w-100">Order</button>
                    @endif
                </div>

            </div>
        </div>
        <div class="col-md-8 border">
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
                                $rating = $current_user_rating -> rating;
                                $count = 0;
                            @endphp

                            @for ($i = 0; $i < (int) $rating; $i++)
                                @php
                                    $count ++;
                                @endphp
                                <i class="text-warning show-service-rating-star fa-solid fa-star" onclick="submitRating({{ $count }})"></i>
                            @endfor
                            @if ($rating - (int) $rating != 0)
                                @php
                                    $count ++;
                                @endphp
                                <i class="text-warning show-service-rating-star fa-regular fa-star-half-stroke" onclick="submitRating({{ $count }})"></i>
                            @endif

                            @while ($count < 5)
                                @php
                                    $count++;
                                @endphp
                                <i class="fa-regular fa-star show-service-rating-star" onclick="submitRating({{ $count }})"></i>
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
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, unde dolore autem enim sunt voluptatem
                    aperiam est molestias. Sunt, adipisci!
                @endguest
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
            console.log(number);
            $('#rating-value').val(number)

            var myModal = new bootstrap.Modal(document.getElementById('ratingModel'));
            myModal.show(300);

        }
    </script>
@endsection
