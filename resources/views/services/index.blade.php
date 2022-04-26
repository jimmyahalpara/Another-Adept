@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceOrders" class="bg-image d-flex justify-content-center align-items-center"
            style="
                                                                                                background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>All Services</h1>
                <h3>{{ Auth::user()->get_organization()->name }}</h3>
            </div>
        </div>
    </section>
    <main class="p-3 px-5">
        <div class="links m-1 d-flex align-items-center justify-content-between">
            <div>
                {{ $services->links() }}
            </div>

            <div class="d-flex align-items-center justify-content-between">
                Num Rows: 
                <div class="d-flex justify-content-center align-items-center">
                    <select name="num_rows" id="num_rows" class="form-control m-1 w-25">
                        <option value="10" @if ($num_rows == 10) selected @endif>10</option>
                        <option value="20" @if ($num_rows == 20) selected @endif>20</option>
                        <option value="50" @if ($num_rows == 50) selected @endif>50</option>
                        <option value="100" @if ($num_rows == 100) selected @endif>100</option>
                        <option value="200" @if ($num_rows == 200) selected @endif>200</option>
                    </select>
                    <a class="btn btn-success" href="{{ route('services.create') }}">Add New Service</a>
                </div>
            </div>

        </div>
        <table class="table table-striped">
            <tr>

                <th>@sortablelink('id')</th>
                <th>@sortablelink('name')</th>
                <th>@sortablelink('price')</th>
                <th>@sortablelink('price_type.name', 'Price Type')</th>
                <th>@sortablelink('service_category.name', 'Service Category')</th>
                <th>@sortablelink('created_at', 'Created At')</th>
                <th>@sortablelink('updated_at', 'Updated At')</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
            @forelse ($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>
                        <a href="{{ route('services.show', ['service' => $service->id]) }}">
                            {{ $service->name }}
                        </a>
                    </td>
                    <td>{{ $service->price }}</td>
                    <td>{{ $service->price_type->name }}</td>
                    <td>{{ $service->service_category->name }}</td>
                    <td>{{ $service->created_at }}</td>
                    <td>{{ $service->updated_at }}</td>
                    <td>
                        @php
                            $service_stat = $service -> user_service_ratings_stat();
                        @endphp
                        (
                            <i class="fa-solid fa-user"></i>
                            {{ $service_stat ? $service_stat -> count : 0 }}
                        )
                        <i class="fa-solid fa-star text-warning"></i>
                        {{ $service_stat ? round($service_stat -> average, 1) : 0 }}

                    </td>
                    <td>
                        <form method="POST" onsubmit="return confirm('Do you really want to delete {{ $service -> name }} service ?')" action="{{ route('services.destroy', ['service' => $service -> id ]) }}" id="delete-form-{{ $service -> id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a onclick="$('#delete-form-{{ $service -> id }}').submit()" class="m-1">

                            
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <a href="{{ route('search.show', ['service' => $service->id]) }}" class="m-1">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                    </td>

                </tr>
            @empty
                <tr>
                    <td>No Services Available</td>
                </tr>
            @endforelse
        </table>
        {{-- <button onclick="document.location='{{ route('services.index') }}'" class="buttonRounded-outlined-light px-3 py-2">Back</button> --}}
    </main>


    <div class="modal fade" id="viewModel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModelTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $("#num_rows").on('change', function(e) {
            value = this.value;

            url = new URL(window.location.href);
            url.searchParams.set('num_rows', value);
            url.searchParams.set('page', 1);
            document.location = url.href;
        });
    </script>
@endsection
