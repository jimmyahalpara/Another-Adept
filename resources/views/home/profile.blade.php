@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>{{ $user->name }}</h1>
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
        <table class="table table-bordered w-50">
            <tr>
                <th>Name:</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Phone Number: </th>
                <td>{{ $user->phone_number }}</td>
            </tr>
            <tr>
                <th>Address:</th>
                <td>{{ $user->address }}</td>
            </tr>
            <tr>
                <th>Area</th>
                <td>{{ $user->area->name }}</td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $user->area->city->name }}</td>
            </tr>
        </table>
        <div class="p-3">
            <button class="btn btn-success" data-bs-toggle='modal' data-bs-target="#editName">Edit Profile</button>
            <a href="{{ route('password.request') }}" class="btn btn-warning">Reset Password</a>
        </div>
    </main>


    {{-- EDIT NAME --}}
    <div class="modal fade" id="editName" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNameTitle">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="name_form">
                        @csrf
                        <b>Full Name: </b>
                        <div class="form-group">
                            <label for="name" class="sr-only">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Full Name"
                                value="{{ $user->name }}">
                        </div>
                        <b>Email: </b>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email address"
                                value="{{ $user->email }}">
                            <small class="small-note">If you change your email address, you'll have to verify
                                it.</small>
                        </div>
                        <b>Phone Number: </b>
                        <div class="form-group">
                            <label for="phone_number" class="sr-only">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control"
                                placeholder="Enter Phone Number" value="{{ $user->phone_number }}">
                        </div>
                        <b>Address: </b>
                        <div class="form-group">
                            <label for="address" class="sr-only">Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                placeholder="Enter Your address" value="{{ $user->address }}">
                        </div>
                        <b>State</b>
                        <div class="form-group">
                            <label for="state_id" class="sr-only">State</label>
                            <select class="form-control" name="state" id="state_id">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->state }}" @if ( $user -> area -> city -> state == $state -> state ) selected @endif>{{ $state->state }}</option>
                                @endforeach
                            </select>
                        </div>
                        <b>City</b>
                        <div class="form-group">
                            <label for="city_id" class="sr-only">City - Area</label>
                            <select class="form-control" name="city_id" id="city_id">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if ( $user -> area -> city -> id == $city -> id ) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <b>Area</b>
                        <div class="form-group mb-4">
                            <label for="area_id" class="sr-only">City - Area</label>
                            <select class="form-control" name="area_id" id="area_id">
                                <option value="">Select Area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @if ( $user -> area -> id == $area -> id ) selected @endif>{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#name_form').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\UserEditRequest', '#name_form') !!}

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

@endsection
