<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Service Adept') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://kit.fontawesome.com/e68c17398d.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <style>
        body {
            font-family: "Karla", sans-serif;
            /* background-color: #d0d0ce; */
        }

    </style>

    {{-- ICON LINKS --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logos/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logos/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logos/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/logos/site.webmanifest') }}">

    <script src="{{ asset('assets/js/readmore.js') }}"></script>


</head>

<body>

    <div id="app">
        @include('layouts.navbar')

        <main class="pb-4">
            @yield('content')
        </main>
    </div>

    <div class="d-none d-md-block">
        <div id="get-help-form">
            @auth
                <div class="w-100 d-flex justify-content-between align-items-center ">
                    <h3 class="w-100">Get Help</h3>
                    <button style="" class="text-light btn btn-sm btn-outline-secondary"
                        onclick="$('#get-help-form').hide()">X</button>
                </div>
                <form action="{{ route('threads.store') }}" method="post" id="global-help-form">
                    @csrf
                    <div class="form-floating mt-4">
                        <textarea name="message" id="message_id" cols="30" rows="10" class="form-control"
                            placeholder="Enter Message"></textarea>
                        <label for="message_id">Enter Your Query Here</label>
                    </div>
                </form>
                <div class="mt-3 d-flex justify-content-center align-items-center flex-column">
                    <button class="btn btn-success" onclick="$('#global-help-form').submit()">
                        Submit
                    </button>
                    <a href="{{ route('threads.index') }}" class="mt-2">View All Threads</a>
                </div>
            @endauth
            @guest
                <h3 class="text-center mt-2">Get Help</h3>
                <div class="w-100 h-100 d-flex justify-content-center align-items-center flex-column">
                    <button class="login-button">Login</button>
                    or
                    <button class="login-button">Sign Up</button>

                </div>
            @endguest
        </div>

        <button id="help-button"><i class="fa-solid fa-question"></i></button>
    </div>

    @include('layouts.footer')
    @if (session('message'))
        {{-- {{ displayErrorMessage() }} --}}
        <script>
            Swal.fire({
                title: "Message",
                text: "{{ session('message') }}"
            });
        </script>
        {{ session(['message' => '']) }}
    @endif

    <style>
        .swal2-modal {
            background-color: rgba(0, 0, 0, 0.323) !important;
            color: white;
            backdrop-filter: blur(10px);
        }

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#price_type_id').on('change', function(e) {
            selection_id = $(this).val();
            console.log(selection_id);
            if (selection_id == {{ config('appconfig.variable_pricetype_id') }}) {
                $('#price').val('0');
                $('#price').attr('disabled', 'true');

            } else {
                $('#price').removeAttr('disabled')
            }
        })

        $('#help-helper').hide();
        $('#get-help-form').hide();
        // $('#help-button').on('mouseout',function() {
        //     $('#help-helper').hide();
        // })

        $('#help-button').on('mouseover', function() {
            $('#get-help-form').show(200);
        });

        $('#get-help-form').on('mouseleave', function() {
            $('#get-help-form').hide(200);
        });

        $('#global-help-form').validate({
            rules: {
                message: {
                    required: true,
                    maxlength: 1000,
                    minlength: 10
                }
            },
            messages: {
                message: {
                    required: "Please enter your message",
                    minlength: "Your message must be at least 10 characters long"
                }
            },
            errorElement: 'span',
            errorClass: 'text-danger is-invalid'
        });
    </script>
</body>


</html>
