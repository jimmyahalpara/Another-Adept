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
    <main class="p-3 px-5">
        <div class="row ">
            <div class="col-md-6 ">
                <div>
                    {{ $services->links() }}
                </div>
            </div>
            <div class="col-md-6 row m-0">
                <div class="col-md-6 col-lg-7 d-flex justify-content-center align-items-center">
                    <input placeholder="Search .. " type="search" name="search_text" id="query" class="form-control"
                        form="filterForm" value="{{ $search_text }}">
                </div>
                <button class="btn btn-primary px-1 col-md-6 col-lg-1" onclick="$('#filterForm').submit()">Search</button>
                <div class="col-lg-2 col-md-6 d-flex justify-content-end align-items-center">
                    Num Rows:
                </div>
                <div class="col-lg-2 col-md-6 d-flex justify-content-center">
                    <select name="num_rows" id="num_rows" class="form-control">
                        <option value="10" @if ($num_rows == 10) selected @endif>10</option>
                        <option value="20" @if ($num_rows == 20) selected @endif>20</option>
                        <option value="50" @if ($num_rows == 50) selected @endif>50</option>
                        <option value="100" @if ($num_rows == 100) selected @endif>100</option>
                        <option value="200" @if ($num_rows == 200) selected @endif>200</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="m-1 row">
            <div class="col-lg-2 border">
                <h4>Filters</h4>
                <div  id="collapseForm">
                    <form id="filterForm" action="" class="m-1">
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
                            <select id="category" class="js-example-basic-multiple" name="categories_filter[]" multiple="multiple">
                                @foreach ($categories as $category)
                                    <option value="{{ $category -> id }}" @if (in_array($category -> id, $categories_filter)) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price Type --}}
                        <div class="form-group">
                            <label for="price_type">Select Price Types</label><br>
                            <select id="price_type" class="js-example-basic-multiple" name="price_types_filter[]" multiple="multiple">
                                @foreach ($price_types as $price_type)
                                    <option value="{{ $price_type -> id }}" @if (in_array($price_type -> id, $price_types_filter)) selected @endif>
                                        {{ $price_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-10">
                t illum dignissimos ad distinctio asperiores iure et maiores voluptatibus blanditiis! Iure consectetur
                sapiente veritatis? Nam quod, consectetur dignissimos pariatur perspiciatis nesciunt laudantium? Natus
                voluptatum dolore itaque placeat repellat, culpa laboriosam animi enim eligendi alias deleniti non maxime
                blanditiis, laborum eaque, quasi officia beatae. Ratione ab placeat voluptatem iure quidem quasi explicabo
                delectus odio ut. Ratione sed nemo ab similique quaerat fugiat quia iure suscipit vitae quibusdam doloribus,
                unde rem sequi quidem perferendis, qui quis at est. Minus sed eos, officiis voluptatibus unde eum eveniet
                esse temporibus repudiandae nihil nam voluptas, debitis aliquam aspernatur mollitia eaque magni ipsum
                repellendus? Aliquam similique adipisci laboriosam atque, dolorem rerum ipsam ea nisi tenetur nam velit,
                quis, neque nihil. Error iure nostrum odit obcaecati, sit autem natus sapiente velit minus laborum ipsum
                eaque explicabo at? Quam consequatur distinctio veniam voluptates et sed odit, eligendi autem nemo
                consequuntur esse molestiae rerum quae natus eum provident quisquam fuga qui aut eius laborum rem.
                Voluptate, velit magnam fugiat voluptatibus similique eum earum culpa ad doloribus ea, rem quod iure. Porro
                nemo sint eum, beatae eligendi consectetur est autem placeat sunt modi obcaecati nulla unde iusto!
                Architecto consectetur, fuga numquam nesciunt autem facilis non ipsam accusamus. Aspernatur sint vitae
                maxime, amet cupiditate voluptates perspiciatis exercitationem qui repellat voluptas vero expedita quibusdam
                provident ex, quae obcaecati rerum. Sapiente vel quod doloremque assumenda doloribus similique dignissimos
                suscipit! Quaerat quas facere minima eveniet quia sint temporibus dolorum? Itaque quo sit dolore modi a
                deleniti cum iusto explicabo quibusdam rem culpa, repudiandae ea facere sequi consequatur sint saepe. Omnis
                eveniet rerum ipsum perspiciatis illo vel. Sequi!
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
