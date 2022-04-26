@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>{{ $member->name }}</h1>
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
                <td>{{ $member->name }}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editName">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $member->email }}</td>
                <td>
                    {{-- <a class="m-1" data-bs-toggle="modal" data-bs-target="#editDescription">
                        <i class="fa-solid fa-pen"></i>
                    </a> --}}
                </td>
            </tr>
            <tr>
                <th>Verified At</th>
                <td>{{ $member->email_verified_at }}</td>
                <td>

                </td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $member->phone_number }}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editPhone">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $member->address }}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editAddress">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>User State</th>
                <td>{{ $member->user_state->name }}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editUserState">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Area</th>
                <td>{{ $member->area->city->name }} - {{ $member->area->name }}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editArea">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>

            <tr>
                <th>Role</th>
                <td>{{ $member->user_role()->name }}</td>
                <td>

                </td>
            </tr>



        </table>
        <button onclick="document.location='{{ route('members.index') }}'"
            class="buttonRounded-outlined-light px-3 py-2">Back</button>
    </main>


    {{-- EDIT NAME --}}
    <div class="modal fade" id="editName" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNameTitle">Edit Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="name_form" action="{{ route('members.name.update', ['member' => $member->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating">
                            <input id="name" type="text" class="w-100 form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $member->name }}" autocomplete="name" placeholder="Enter Name"
                                @error('name') autofocus @enderror">
                            <label for="name">Member Name</label>
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

    {{-- EDIT PHONE NUMBER --}}
    <div class="modal fade" id="editPhone" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhoneTitle">Edit Phone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="phone_number_form" action="{{ route('members.phone.update', ['member' => $member->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating">
                            <input id="phone_number" type="text"
                                class="w-100 form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                value="{{ $member->phone_number }}" autocomplete="phone_number" placeholder="Enter Name"
                                @error('phone_number') autofocus @enderror">
                            <label for="phone_number">Member Phone</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#phone_number_form').submit()">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT ADDRESS --}}
    <div class="modal fade" id="editAddress" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAddressTitle">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="address_form" action="{{ route('members.address.update', ['member' => $member->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating">
                            <input id="address" type="text"
                                class="w-100 form-control @error('address') is-invalid @enderror" name="address"
                                value="{{ $member->address }}" autocomplete="address" placeholder="Enter Name"
                                @error('address') autofocus @enderror">
                            <label for="address">Member Address</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#address_form').submit()">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT USER STATE --}}
    <div class="modal fade" id="editUserState" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserStateTitle">Edit State</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="state_form" action="{{ route('members.state.update', ['member' => $member->id]) }}"
                        method="post">
                        @csrf
                        <div class="form-floating my-4">
                            <select name="state_id" class="w-100 form-control @error('state_id') is-invalid @enderror"
                                @error('state_id') autofocus @enderror>
                                @foreach ($user_states as $state)
                                    <option value="{{ $state->id }}" @if ($state->id == $member->user_state->id) selected @endif>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="state_id">Select User State</label>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#state_form').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Area --}}
    <div class="modal fade" id="editArea" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAreaTitle">Edit Area</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="area_form" action="{{ route('members.area.update', ['member' => $member->id]) }}"
                        method="post">
                        @csrf
                        {{-- <div class="form-floating my-4">
                            <select name="area_id" class="w-100 form-control @error('area_id') is-invalid @enderror"
                                @error('area_id') autofocus @enderror>
                                <option value="">Select Area</option>
                                @foreach ($cities as $city)
                                    <optgroup label="{{ $city->name }}">
                                        @foreach ($city->areas->sortBy('name') as $area)
                                            <option value="{{ $area->id }}"
                                                @if ($area->id == $member->area->id) selected @endif>{{ $area->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <label for="area_id">Select Area</label>
                        </div> --}}

                        <div class="form-floating mb-4">
                            <label for="state_id" class="sr-only">State</label>
                            <select class="form-control" name="state" id="state_id">
                                <option value="">Select State</option>


                                @foreach ($states as $state)
                                    <option value="{{ $state->state }}"
                                        @if ($member->area->city->state == $state->state) selected @endif>{{ $state->state }}</option>
                                @endforeach
                            </select>
                            <label for="state_id">Select State</label>
                        </div>
                        <div class="form-floating mb-4">
                            <label for="city_id" class="sr-only">City - Area</label>
                            <select class="form-control" name="city_id" id="city_id">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if ($member->area->city->id == $city->id) selected @endif>
                                        {{ $city->name }}</option>
                                @endforeach
                            </select>
                            <label for="city_id">Select City</label>
                        </div>

                        <div class="form-floating mb-4">
                            <label for="area_id" class="sr-only">City - Area</label>
                            <select class="form-control" name="area_id" id="area_id">
                                <option value="">Select Area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @if ($member->area->id == $area->id) selected @endif>
                                        {{ $area->name }}</option>
                                @endforeach
                            </select>
                            <label for="area_id">Select Area</label>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#area_form').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>






    {{-- EDIT DESCRIPTION --}}
    {{-- <div class="modal fade" id="editDescription" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDescriptionTitle">Edit Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="description_form"
                        action="{{ route('members.description.update', ['member' => $member->id]) }}" method="post">
                        @csrf

                        <div class="form-floating">
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter Description of Your Organizaiton" id="floatingTextarea2"
                                style="height: 100px" name="description"
                                @error('description') autofocus @enderror>{{ $member->description }}</textarea>
                            <label for="floatingTextarea2">member Description</label>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#description_form').submit()">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div> --}}

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
