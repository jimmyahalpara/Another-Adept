@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceCreate" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/thirdImage.jpg') }}');">

            <div id="organization-form-container"
                class="p-5 mx-5 d-flex justify-content-center align-items-center flex-column">
                <h1>Create New Service</h1>
                <form action="{{ route('services.store') }}" method="post" id="create-organization-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="login-form-group form-floating my-4">
                        <input id="name" type="text" class="w-100 form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" autocomplete="name"
                            placeholder="Enter Organization Name" @error('name') autofocus @enderror
                            value="{{ old('name') }}">
                        <label for="name">Service Name</label>
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
                        <label for="floatingTextarea2">Service Description</label>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="login-form-group form-floating my-4">
                        <input id="price" type="number" class="w-100 form-control @error('price') is-invalid @enderror"
                            name="price" value="{{ old('price') }}" autocomplete="price"
                            placeholder="Enter Organization Name" @error('price') autofocus @enderror
                            value="{{ old('price') }}">
                        <label for="price">Price</label>
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="login-form-group form-floating my-4">
                        <select name="price_type_id" id="price_type_id"
                            class="w-100 form-control @error('price_type_id') is-invalid @enderror"
                            @error('price_type_id') autofocus @enderror>
                            @foreach ($price_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <label for="price_type_id">Price</label>
                        @error('price_type_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="login-form-group form-floating my-4">
                        <select name="area_id" id="area_id"
                            class="w-100 form-control @error('area_id') is-invalid @enderror"
                            @error('area_id') autofocus @enderror>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" @if (old('area_id') == $area->id) selected @endif>
                                    {{ $area->city->name }} - {{ $area->name }}</option>
                            @endforeach
                        </select>
                        <label for="area_id">Area</label>
                        @error('area_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="login-form-group form-floating my-4">
                        <select name="service_category_id" id="service_category_id"
                            class="w-100 form-control @error('service_category_id') is-invalid @enderror"
                            @error('service_category_id') autofocus @enderror>
                            @foreach ($service_categories as $category)
                                <option value="{{ $category->id }}" @if (old('service_category_id') == $category->id) selected @endif>
                                    {{ $category -> name }}</option>
                            @endforeach
                        </select>
                        <label for="service_category_id">Service Category</label>
                        <p class="small-note"><small>
                            Note: If the service that you provide does not lie in the above mentioned categories, then send us a request theough help center. We would love to include more service types to our platform.
                        </small></p>
                        @error('service_category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="service_image">Service Image</label>
                        <p class="small-note"><small>
                                Note: You'll need to upload an image for your service.
                            </small></p>
                        <input type="file" name="service_image" id="service_image"
                            class="form-control @error('service_image') is-invalid @enderror"
                            @error('service_image') autofocus @enderror>

                        @error('service_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="d-flex justify-content-center align-items-center m-3">
                        <button type="submit" class="buttonRounded-organization p-2 px-4">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
            <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
            {!! JsValidator::formRequest('App\Http\Requests\CreateOrganizatinRequest', '#create-organization-form') !!}


        </div>
        </div>
    </section>
@endsection
