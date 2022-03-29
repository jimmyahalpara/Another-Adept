@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="
                                                                                                                                                                                        background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>{{ $service->name }}</h1>
                <h3>{{ Auth::user()->get_organization()->name }}</h3>
            </div>
        </div>
    </section>
    <main class="p-3 px-5 d-flex justify-content-center align-items-center flex-column">
        <img src="{{ $service->images->first()->image_path }}" alt="" class="service-image">
        <button type="button" class="m-2 btn btn-success" data-bs-toggle="modal" data-bs-target="#editImage">
            Upload New Image
        </button>
        @if (!$errors->isEmpty())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span><br>
                @endforeach
            </div>
        @endif
        <table class="table w-50">
            <tr>
                <th>Name </th>
                <td>{{ $service->name }}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editName">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Description </th>
                <td>{{ $service->description }}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editDescription">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Price </th>
                <td>{{ $service->price }}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editPrice">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Price Type </th>
                <td>{{ $service->price_type->name }}</td>
                <td>
                    <a data-bs-toggle="modal" data-bs-target="#editPriceType" class="m-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Service Category </th>
                <td>{{ $service->service_category->name }}</td>
                <td>
                    <a data-bs-toggle="modal" data-bs-target="#editServiceCategory" class="m-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Areas </th>
                <td>
                    @foreach ($service->areas as $area)
                        {{ $area->city->name }} - {{ $area->name }}
                        <hr>
                    @endforeach
                </td>
                <td>
                    <a data-bs-toggle="modal" data-bs-target="#editArea" class="m-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Created At </th>
                <td>{{ $service->created_at }}</td>
                <td>
                    <a href="" class="m-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Updated At </th>
                <td>{{ $service->updated_at }}</td>
                <td>
                    <a href="" class="m-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Deleted At </th>
                <td>{{ $service->deleted_at }}</td>
                <td>
                    <a href="" class="m-1">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>

        </table>
    </main>

    {{-- EDIT IMAGE --}}
    <div class="modal fade" id="editImage" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editImageTitle">Upload New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="image_form" action="{{ route('services.image.change', ['service' => $service->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" id="service_image" class="form-control">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#image_form').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT NAME --}}
    <div class="modal fade" id="editName" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNameTitle">Edit Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="name_form" action="{{ route('services.name.update', ['service' => $service->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating">
                            <input id="name" type="text" class="w-100 form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $service->name }}" autocomplete="name" placeholder="Enter Name"
                                @error('name') autofocus @enderror">
                            <label for="name">Service Name</label>
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


    {{-- EDIT DESCRIPTION --}}
    <div class="modal fade" id="editDescription" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDescriptionTitle">Edit Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="description_form"
                        action="{{ route('services.description.update', ['service' => $service->id]) }}" method="post">
                        @csrf

                        <div class="form-floating">
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter Description of Your Organizaiton" id="floatingTextarea2"
                                style="height: 100px" name="description"
                                @error('description') autofocus @enderror>{{ $service->description }}</textarea>
                            <label for="floatingTextarea2">Service Description</label>

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
    </div>

    {{-- EDIT PRICE --}}
    <div class="modal fade" id="editPrice" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPriceTitle">Edit Price</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="price_form" action="{{ route('services.price.update', ['service' => $service->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating">
                            <input id="price" type="number" class="w-100 form-control @error('price') is-invalid @enderror"
                                name="price" value="{{ $service->price }}" autocomplete="price"
                                placeholder="Enter Organization Name" @error('price') autofocus @enderror>
                            <label for="price">Price</label>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#price_form').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT PRICE TYPE --}}
    <div class="modal fade" id="editPriceType" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPriceTypeTitle">Edit Price Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="price_type_form"
                        action="{{ route('services.price.type.update', ['service' => $service->id]) }}" method="post">
                        @csrf

                        <div class="form-floating my-4">
                            <select name="price_type_id" id="price_type_id"
                                class="w-100 form-control @error('price_type_id') is-invalid @enderror"
                                @error('price_type_id') autofocus @enderror>
                                <option value="">Select Price Type</option>
                                @foreach ($price_types as $type)
                                    <option value="{{ $type->id }}" @if ($type->id == $service->price_type_id) selected @endif>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                            <label for="price_type_id">Price</label>
                            @error('price_type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#price_type_form').submit()">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>


    {{-- EDIT SERVICE CATEGORY --}}
    <div class="modal fade" id="editServiceCategory" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceCategoryTitle">Edit Service Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="service_category_form"
                        action="{{ route('services.service.category.update', ['service' => $service->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating my-4">
                            <select name="service_category_id" id="service_category_id"
                                class="w-100 form-control @error('service_category_id') is-invalid @enderror"
                                @error('service_category_id') autofocus @enderror>
                                <option value="">Select Service Category</option>
                                @foreach ($service_categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($service->service_category_id == $category->id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="service_category_id">Service Category</label>
                            @error('service_category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#service_category_form').submit()">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT AREA --}}
    <div class="modal fade" id="editArea" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAreaTitle">Edit Area</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="area_form" action="{{ route('services.area.update', ['service' => $service->id]) }}"
                        method="post">
                        @csrf

                        @php
                            $num_area = 0;
                        @endphp
                        <div id="area_container">
                            @php
                                $num_area += 1;
                            @endphp
                            @foreach ($service->areas as $service_area)
                                <div class="form-floating my-4" id="area_container_{{ $num_area }}">
                                    <select name="area[]" id="area_id_1"
                                        class="w-100 form-control @error('area_id_{{ $num_area }}') is-invalid @enderror"
                                        @error('area_id_{{ $num_area }}') autofocus @enderror>
                                        <option value="">Select Area</option>
                                        @foreach ($cities as $city)
                                            <optgroup label="{{ $city->name }}">
                                                @foreach ($city->areas->sortBy('name') as $area)
                                                    <option value="{{ $area->id }}"
                                                        @if ($service_area->id == $area->id) selected @endif>
                                                        {{ $area->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <div class="w-100 d-flex justify-content-end align-items-center">
                                        <button onclick="$('#area_container_{{ $num_area }}').remove()" type="button"
                                            class="buttonRounded-organization float-right mt-1 p-2 px-4">
                                            Remove
                                        </button>
                                    </div>
                                    <label for="area_id_{{ $num_area }}">Area</label>
                                    @error('area_id_{{ $num_area }}')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <button onclick="addArea()" type="button" class="buttonRounded-organization p-2 px-4">
                            Add Area
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#area_form').submit()">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>






    <script>
        var num_area = {{ $num_area }};
        $("#num_rows").on('change', function(e) {
            value = this.value;

            url = new URL(window.location.href);
            url.searchParams.set('num_rows', value);
            url.searchParams.set('page', 1);
            document.location = url.href;
        });


        function addArea() {
            num_area += 1;

            $area_container = $('#area_container');
            area_html = `<div class="form-floating my-4" id="area_container_` + num_area + `">
                            <select name="area[]" id="area_id_` + num_area + `"
                                class="w-100 form-control @error('area_id_`+num_area+`') is-invalid @enderror"
                                @error('area_id_`+num_area+`') autofocus @enderror>
                                <option value="">Select Area</option>
                                @foreach ($cities as $city)
                                    <optgroup label="{{ $city->name }}">
                                        @foreach ($city->areas->sortBy('name') as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </optgroup>
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

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ImageUploadRequest', '#image_form') !!}
@endsection
