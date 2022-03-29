@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>{{ $organization -> name }}</h1>
            </div>
        </div>
    </section>
    <main class="p-3 px-5 d-flex justify-content-center align-items-center flex-column">

    </main>


    {{-- EDIT NAME --}}
    {{-- <div class="modal fade" id="editName" tabindex="-1">
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
                                name="name" value="{{ $organization->name }}" autocomplete="name" placeholder="Enter Name"
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
    </div> --}}


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
                        action="{{ route('services.description.update', ['service' => $service->id]) }}" method="post">
                        @csrf

                        <div class="form-floating">
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter Description of Your Organizaiton" id="floatingTextarea2"
                                style="height: 100px" name="description"
                                @error('description') autofocus @enderror>{{ $organization->description }}</textarea>
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
    </div> --}}
@endsection
