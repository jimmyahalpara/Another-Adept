@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>{{ $organization->name }}</h1>
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
                <td>{{ $organization->name }}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editName">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{!! nl2br(e($organization->description)) !!}</td>
                <td>
                    <a class="m-1" data-bs-toggle="modal" data-bs-target="#editDescription">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th class="" >
                    <h6>PAYMENT INFORMATION</h6>
                </th>
                <td></td>
                <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editBankDetails">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                </td>
            </tr>

            @if ($organization -> organization_payment_information)
                <tr>
                    <th>Bank Name </th>
                    <td>{{ $organization -> organization_payment_information -> bank_name }}</td>
                </tr>
                <tr>
                    <th>Account Number </th>
                    <td>{{ $organization -> organization_payment_information -> bank_account_number }}</td>
                </tr>
                <tr>
                    <th>IFSC Code </th>
                    <td>{{ $organization -> organization_payment_information -> ifsc }}</td>
                </tr>
            @endif
        </table>
        <button onclick="document.location='{{ route('home') }}'"
            class="buttonRounded-outlined-light px-3 py-2">
            Back
        </button>

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
                    <form id="name_form"
                        action="{{ route('organizations.name.update', ['organization' => $organization->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating">
                            <input id="name" type="text" class="w-100 form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $organization->name }}" autocomplete="name" placeholder="Enter Name"
                                @error('name') autofocus @enderror">
                            <label for="name">Organization Name</label>
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
                        action="{{ route('organizations.description.update', ['organization' => $organization->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating">
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter Description of Your Organizaiton" id="floatingTextarea2"
                                style="height: 100px" name="description"
                                @error('description') autofocus @enderror>{{ $organization->description }}</textarea>
                            <label for="floatingTextarea2">Organization Description</label>

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

    <div class="modal fade" id="editBankDetails" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBankDetailsTitle">Edit Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBankDetailsForm"
                        action="{{ route('organizations.description.update', ['organization' => $organization->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating m-3">
                            <input class="form-control" placeholder="Enter Bank Detail" type="text" name="bank_name" id="bank_name_id" value="{{ ($organization -> organization_payment_information) ? ($organization -> organization_payment_information -> bank_name) : '' }}">
                            <label for="bank_name_id">Enter Bank Name</label>
                        </div>
                        <div class="form-floating m-3">
                            <input class="form-control" placeholder="Enter Bank Account Number" type="text" name="bank_account_number" id="bank_account_number_id" value="{{ ($organization -> organization_payment_information) ? ($organization -> organization_payment_information -> bank_account_number) : '' }}">
                            <label for="bank_name_id">Enter Bank Account Number</label>
                        </div>
                        <div class="form-floating m-3">
                            <input class="form-control" placeholder="Enter IFSC Code" type="text" name="ifsc" id="ifsc_id" value="{{ ($organization -> ifsc) ? ($organization -> ifsc -> bank_account_number) : '' }}">
                            <label for="bank_name_id">Enter IFSC Code</label>
                        </div>
                        <div class="form-floating m-3">
                            <input class="form-control" placeholder="Enter UPI ID" type="text" name="upi_id" id="upi_id" value="{{ ($organization -> organization_payment_information) ? ($organization -> organization_payment_information -> upi_id) : '' }}">
                            <label for="upi_id">Enter UPI ID</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#editBankDetailsForm').submit()">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
