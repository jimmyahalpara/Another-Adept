@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceSearch" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column" style="">
                <h1>My Orders</h1>

            </div>
        </div>
    </section>
    <main class="p-3">
            <div class="col-lg-10 p-1" id="main-service-container">
                @forelse ($orders as $order)
                    @php
                        $service = $order -> service;
                    @endphp
                    @include('home.partials.order')
                @empty
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center flex-column">
                        <img id="no-result-image" src="{{ asset('assets/images/noresult.gif') }}" alt="No Result">
                        <div id="no-result-text" class="d-flex justify-content-center align-items-center flex-column">
                            <h1>No Results Found</h1>
                            <a href="{{ route('home.cart') }}" class="link-heading">
                                Want to try resetting filters ?
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="m-1 d-flex justify-content-center align-items-center">
                {{ $orders->links() }}
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

                    if (!confirm('Do You want to delete this service ?')){
                        return;
                    }
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
                    
                    dislikedlikedSuccessFully();
                    $('#service-partial-' + service_id).remove();

                    if($('#main-service-container').children().length <= 0){
                        html = `
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center flex-column">
                        <img id="no-result-image" src="{{ asset('assets/images/noresult.gif') }}" alt="No Result">
                        <div id="no-result-text" class="d-flex justify-content-center align-items-center flex-column">
                            <h1>No Results Found</h1>
                            <a href="{{ route('home.cart') }}" class="link-heading">
                                Want to try resetting filters ?
                            </a>
                        </div>
                        </div>
                        `;

                        $('#main-service-container').html(html);
                    }
                
                    if (response <= 0){ $user_like_number.html(''); $user_like_icon.removeClass('fa-solid');
                        $user_like_icon.removeClass('fa-regular'); $user_like_icon.removeClass('text-danger');
                        $user_like_icon.addClass('fa-regular'); } else { $user_like_number.html(response); } }, error: function
                        (response) { console.log(response); } }); } @endif
            @endauth
            @guest
                document.location='{{ route('login') }}';
            @endguest

        }

        function dislikedlikedSuccessFully() {
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
                title: 'Service Disliked'
            });
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



    </script>
@endsection
