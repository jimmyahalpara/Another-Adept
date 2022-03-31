@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceSearch" class="bg-image d-flex justify-content-center align-items-center"
            style="
                                                                                                                        background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column" style="">
                <h1>Services</h1>

            </div>
        </div>
    </section>
    <main class="p-3">
        <div class="row">
            <div class="col-md-7 ">
            </div>
            <div class="col-md-5 row m-0 align-items-center">
                <div class="col-md-6 col-lg-9 d-flex justify-content-center align-items-center">
                    <input placeholder="Search .. " type="search" name="search_text" id="query" class="form-control"
                        form="filterForm" value="{{ $search_text }}">
                </div>
                <button class="btn btn-primary px-1 col-md-6 col-lg-3"  onclick="$('#filterForm').submit()">Search</button>

            </div>
        </div>
        <div class="m-1 row">
            <div class="col-lg-2">
                <h4>Filters</h4>
                <div id="collapseForm">
                    <form id="filterForm" action="" class="m-1">
                        <input type="hidden" name="num_rows" value="{{ $num_rows }}">

                        {{-- Price range --}}
                        <div class="form-group">
                            <label>Price Range</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="number" class="form-control d-inlin-block" name="min_price" id="min_price" placeholder="MIN" value="{{ $min_price }}">
                                </div>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control d-inlin-block" name="max_price" id="max_price" placeholder="MAX" value="{{ $max_price }}">
                                </div>
                            </div>
                        </div>
                        {{-- Price Type --}}
                        <div class="form-group">
                            <label for="price_type">Select Price Types</label><br>
                            <select id="price_type" class="js-example-basic-multiple" name="price_types_filter[]"
                                multiple="multiple">
                                @foreach ($price_types as $price_type)
                                    <option value="{{ $price_type->id }}"
                                        @if (in_array($price_type->id, $price_types_filter)) selected @endif>
                                        {{ $price_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Areas --}}
                        <div class="form-group">
                            <label for="area">Select Areas</label><br>
                            <select id="area" class="js-example-basic-multiple" name="areas[]" multiple="multiple">
                                @foreach ($cities as $city)
                                    <optgroup label="{{ $city->name }}">
                                        @foreach ($city->areas->sortBy('name') as $area)
                                            <option value="{{ $area->id }}"
                                                @if (in_array($area->id, $areas)) selected @endif>{{ $area->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        {{-- Categories --}}
                        <div class="form-group">
                            <label for="category">Select Categories</label><br>
                            <select id="category" class="js-example-basic-multiple" name="categories_filter[]"
                                multiple="multiple">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if (in_array($category->id, $categories_filter)) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SELECT ORGANIZATIONS --}}
                        <div class="form-group">
                            <label for="organization">Select Organization</label><br>
                            <select id="organization" class="js-example-basic-multiple" name="organization_filter[]"
                                multiple="multiple">
                                @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}"
                                        @if (in_array($organization->id, $organization_filter)) selected @endif>
                                        {{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        

                        
                    </form>
                </div>
            </div>
            <div class="col-lg-10 p-1">
                @foreach ($services as $service)
                    @include('search.partials.service')
                @endforeach
            </div>
            <div class="m-1 d-flex justify-content-center align-items-center">
                {{ $services->links() }}
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
    </script>
@endsection
