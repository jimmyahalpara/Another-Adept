@extends('layouts.app')



@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introOrg" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/secondImage.jpg') }}');">
            <div class="" style="">
                @organization_member
                    @organization_inactive
                        <h1>Your Request is being verified</h1>
                    @else
                        <h1>You Already are hardworking member of an Organization </h1>
                    @endorganization_inactive
            @else
                <div id="organization-form-container"
                    class="p-5 mx-5 d-flex justify-content-center align-items-center flex-column">
                    <h1>Create Your Own Organization</h1>
                    <small>What is an Organization ? We term any business hosted on our site as organization</small>
                    <form action="{{ route('organizations.store') }}" method="post" id="create-organization-form" enctype="multipart/form-data">
                        @csrf
                        <div class="login-form-group form-floating my-4">
                            <input id="name" type="text" class="w-100 form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" autocomplete="name"
                                placeholder="Enter Organization Name" @error('name') autofocus @enderror
                                value="{{ old('name') }}">
                            <label for="name">Organization Name</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter Description of Your Organizaiton" id="floatingTextarea2"
                                style="height: 100px" name="description"
                                @error('description') autofocus @enderror>{{ old('description') }}</textarea>
                            <label for="floatingTextarea2">Description of Organization</label>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <p class="small-note">
                            <small>
                                Note: The currently logged-in user will be the admin/head/owner of this organization and all
                                its contact details will be used for further communications. If you wish against it, then
                                create a new User specially for this purpose.
                            </small>
                        </p>

                        <div class="form-group">
                            <label for="identification">Photo ID</label>
                            <p class="small-note"><small>
                                    Note: Please Enter Valid Photo ID Card.Only After its verification from our side,
                                    you'll be able to host your services or register other members.
                                </small></p>
                            <input type="file" name="identification" id="identification"
                                class="form-control @error('identification') is-invalid @enderror"
                                @error('identification') autofocus @enderror>

                            @error('identification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center align-items-center m-3">
                            <button type="submit" class="buttonRounded-organization m-1 p-2 px-4">
                                Submit
                            </button>
                            <button onclick="document.location='{{ route('home') }}'" type="button" class="buttonRounded-organization-outlined m-1 p-2 px-4">
                                Cancel
                            </button>
                        </div>
                    </form>

                </div>
                <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
                {!! JsValidator::formRequest('App\Http\Requests\CreateOrganizatinRequest', '#create-organization-form') !!}
                @endorganization_member


            </div>
        </div>
    </section>
@endsection
