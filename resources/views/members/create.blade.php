@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceCreate" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/thirdImage.jpg') }}');">

            <div id="organization-form-container"
                class="p-5 mx-5 d-flex justify-content-center align-items-center flex-column">
                <h1>Create New Member</h1>
                @if (!$errors->isEmpty())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span><br>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('members.store') }}" method="post" id="create-organization-form">
                    @csrf

                    {{-- NAME --}}
                    <div class="login-form-group form-floating my-4">
                        <input type="text" name="name" placeholder="Full Name" id="name"
                            class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            autocomplete="name" @error('name') autofocus @enderror>
                        <label for="name">Enter Full Name</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <p class="small-note">
                        <small>
                            Note: This email needs to be verified using the link sent to this email after you create this
                            user successfully, then only they'll be able to provide any service.
                        </small>
                    </p>
                    <div class="login-form-group form-floating my-4">
                        <input type="email" name="email" placeholder="Email Address" id="email"
                            class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            autocomplete="email" @error('email') autofocus @enderror>
                        <label for="email">Enter Email Address</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="login-form-group form-floating my-4">
                        <input type="password" name="password" placeholder="Enter Password" id="password"
                            class="form-control  @error('password') is-invalid @enderror" value="{{ old('password') }}"
                            autocomplete="password" @error('password') autofocus @enderror>
                        <label for="password">Enter Password</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- PASSWORD CONFIRMATION --}}
                    <div class="login-form-group form-floating my-4">
                        <input type="password" name="password_confirmation" placeholder="Email Address"
                            id="password_confirmation"
                            class="form-control  @error('password_confirmation') is-invalid @enderror"
                            value="{{ old('password_confirmation') }}" autocomplete="password_confirmation"
                            @error('password_confirmation') autofocus @enderror>
                        <label for="password_confirmation">Confirm Password Password</label>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    {{-- PHONE NUMBER --}}
                    <div class="login-form-group form-floating my-4">
                        <input type="text" name="phone_number" placeholder="Enter Phone Number" id="phone_number"
                            class="form-control  @error('phone_number') is-invalid @enderror"
                            value="{{ old('phone_number') }}" autocomplete="phone_number"
                            @error('phone_number') autofocus @enderror>
                        <label for="phone_number">Enter Phone Number</label>
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    {{-- ADDRESS --}}
                    <div class="login-form-group form-floating my-4">
                        <input type="text" name="address" placeholder="Enter Phone Number" id="address"
                            class="form-control  @error('address') is-invalid @enderror" value="{{ old('address') }}"
                            autocomplete="address" @error('address') autofocus @enderror>
                        <label for="address">Enter Your Address</label>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- AREA ID --}}
                    <div class="form-floating mb-4">
                        <label for="state_id" class="sr-only">State</label>
                        <select class="form-control" name="state" id="state_id">
                            <option value="">Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->state }}">{{ $state->state }}</option>
                            @endforeach
                        </select>
                        <label for="state_id">Select State</label>
                    </div>
                    <div class="form-floating mb-4">
                        <label for="city_id" class="sr-only">City - Area</label>
                        <select class="form-control" name="city_id" id="city_id">
                            <option value="">Select City</option>
                        </select>
                        <label for="city_id">Select City</label>
                    </div>

                    <div class="form-floating mb-4">
                        <label for="area_id" class="sr-only">City - Area</label>
                        <select class="form-control" name="area_id" id="area_id">
                            <option value="">Select Area</option>
                        </select>
                        <label for="area_id">Select Area</label>
                    </div>

                    {{-- ROLE --}}
                    <div class="login-form-group form-floating my-4">
                        <select name="role" class="w-100 form-control @error('role') is-invalid @enderror"
                            @error('role') autofocus @enderror>
                            @foreach ($organization_roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <label for="role">Select Role in Organization</label>
                    </div>

                    <div class="d-flex justify-content-center align-items-center m-3">
                        <button type="submit" class="buttonRounded-organization p-2 px-4">
                            Submit
                        </button>
                    </div>
                </form>

            </div>

            <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
            {!! JsValidator::formRequest('App\Http\Requests\UserRegisterRequest', '#create-organization-form') !!}
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

        </div>
    </section>

@endsection
