{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Adept</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logos/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logos/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logos/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/logos/site.webmanifest') }}">
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 my-4 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <h1>Service Adept</h1>
                            </div>
                            <p class="login-card-description">Register New Account</p>
                            @if (!$errors->isEmpty())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <span>{{ $error }}</span><br>
                                    @endforeach
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}" id="register-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="sr-only">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter Full Name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">

                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email address" value="{{ old('email') }}">

                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter Password">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password_confirmation" class="sr-only">Reenter Password</label>
                                    <input type="password" name="password_confirmation" id="password-confirm"
                                        class="form-control" placeholder="Re Enter Password">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="phone_number" class="sr-only">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                                        placeholder="Enter Phone Number" value="{{ old('phone_number') }}">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="address" class="sr-only">Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="Enter Your address" value="{{ old('address') }}">
                                </div>

                                <div class="form-group mb-4">
                                    <label for="state_id" class="sr-only">State</label>
                                    <select class="form-control" name="state" id="state_id">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->state }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="city_id" class="sr-only">City - Area</label>
                                    <select class="form-control" name="city_id" id="city_id">
                                        <option value="">Select City</option>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="area_id" class="sr-only">City - Area</label>
                                    <select class="form-control" name="area_id" id="area_id">
                                        <option value="">Select Area</option>
                                    </select>
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit"
                                    value="Register">
                            </form>
                            {{-- <a href="#!" class="forgot-password-link">Forgot password?</a> --}}
                            {{-- <p class="login-card-footer-text">Don't have an account? <a href="#!" --}}
                            {{-- class="text-reset">Register here</a></p> --}}
                            <nav class="login-card-footer-nav">
                                <a href="www.google.com">Terms of use.</a>
                                <a href="#!">Privacy policy</a>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="assets/images/login.jpg" alt="login" class="login-card-img">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\UserRegisterRequest', '#register-form') !!}


    <script>
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
                        $('#area_id').html('<option value="">Select Area</option>');
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
</body>

</html>
