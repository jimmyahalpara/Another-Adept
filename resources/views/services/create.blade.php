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
                @if (!$errors->isEmpty())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span><br>
                        @endforeach
                    </div>
                @endif
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
                            <option value="">Select Price Type</option>
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
                    <div id="area_container">
                        <div class="login-form-group form-floating my-4" id="area_container_1">
                            <select name="area[]" id="area_id_1"
                                class="w-100 form-control @error('area_id_1') is-invalid @enderror"
                                @error('area_id_1') autofocus @enderror>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" @if (old('area_id_1') == $area->id) selected @endif>
                                        {{ $area->city->name }} - {{ $area->name }}</option>
                                @endforeach
                            </select>
                            <div class="w-100 d-flex justify-content-end align-items-center">
                                <button onclick="$('#area_container_1').remove()" type="button"
                                    class="buttonRounded-organization float-right mt-1 p-2 px-4">
                                    Remove
                                </button>
                            </div>
                            <label for="area_id_1">Area</label>
                            @error('area_id_1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div>

                    <button onclick="addArea()" type="button" class="buttonRounded-organization p-2 px-4">
                        Add Area
                    </button>



                    {{-- <div class="my-4">
                        <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div> --}}





                    <div class="login-form-group form-floating my-4">
                        <select name="service_category_id" id="service_category_id"
                            class="w-100 form-control @error('service_category_id') is-invalid @enderror"
                            @error('service_category_id') autofocus @enderror>
                            <option value="">Select Service Category</option>
                            @foreach ($service_categories as $category)
                                <option value="{{ $category->id }}" @if (old('service_category_id') == $category->id) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="service_category_id">Service Category</label>
                        <p class="small-note"><small>
                                Note: If the service that you provide does not lie in the above mentioned categories, then
                                send us a request theough help center. We would love to include more service types to our
                                platform.
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
            {!! JsValidator::formRequest('App\Http\Requests\CreateServiceRequest', '#create-organization-form') !!}


        </div>
        </div>
    </section>
    <script>
        var num_area = 1;
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });



        function addArea() {
            num_area += 1;

            $area_container = $('#area_container');
            area_html = `<div class="login-form-group form-floating my-4" id="area_container_` + num_area + `">
                            <select name="area[]" id="area_id_` + num_area + `"
                                class="w-100 form-control @error('area_id_`+num_area+`') is-invalid @enderror"
                                @error('area_id_`+num_area+`') autofocus @enderror>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">
                                        {{ $area->city->name }} - {{ $area->name }}</option>
                                @endforeach
                            </select>
                            <div class="w-100 d-flex justify-content-end align-items-center">
                                <button onclick="$('#area_container_` + num_area + `').remove()" type="button"
                                    class="buttonRounded-organization float-right mt-1 p-2 px-4">
                                    Remove
                                </button>
                            </div>
                            <label for="area_id_` + num_area + `">Area</label>
                            @error('area_id_`+num_area+`')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>`;
            console.log($area_container);
            $area_container.append(area_html);
        }
    </script>
@endsection
