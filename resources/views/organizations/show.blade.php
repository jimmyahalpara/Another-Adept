@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/background (5).jpg') }}'); background-position: 0% 50%">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0);">
                <h1 style="color: white; text-shadow: 0px 0px 10px black">{{ $organization->name }}</h1>
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
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>Wallet Balence</th>
                <td>
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                    {{ $organization->wallet_balance }}
                </td>
                <td>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#requestPayout">
                        Request Payout
                    </button>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    {{-- table containing organization_payout information --}}
                    <table class="table table-striped w-100">
                        <tr>
                            <th>ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                        @forelse ($organization->organization_payouts() -> orderBy('status') -> get() as $payout)
                            <tr>
                                <td>{{ $payout->id }}</td>
                                <td>{{ $payout->amount }}</td>
                                @if ($payout->status == 0)
                                    <td>
                                        <span class="badge bg-warning">Pending</span>
                                    </td>
                                @elseif ($payout->status == 1)
                                    <td>
                                        <span class="badge bg-success">Accepted</span>
                                    </td>
                                @elseif ($payout->status == 2)
                                    <td>
                                        <span class="badge bg-danger">Rejected</span>
                                    </td>
                                @endif
                                <td>{{ $payout->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Request Found</td>
                            </tr>
                        @endforelse
                    </table>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="">
                    PAYMENT INFORMATION
                </th>
                <td></td>
                <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editBankDetails">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                </td>
            </tr>
            @if ($organization->organization_payment_information)
                <tr>
                    <th>Bank Name </th>
                    <td>{{ $organization->organization_payment_information->bank_name }}</td>
                </tr>
                <tr>
                    <th>Account Number </th>
                    <td>{{ $organization->organization_payment_information->bank_account_number }}</td>
                </tr>
                <tr>
                    <th>IFSC Code </th>
                    <td>{{ $organization->organization_payment_information->ifsc }}</td>
                </tr>
                <tr>
                    <th>UPI ID </th>
                    <td>{{ $organization->organization_payment_information->upi_id }}</td>
                </tr>
            @endif
        </table>
        <button onclick="document.location='{{ route('home') }}'" class="buttonRounded-outlined-light px-3 py-2">
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
                                name="name" value="{{ $organization->name }}" autocomplete="name"
                                placeholder="Enter Name" @error('name') autofocus @enderror">
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


    {{-- REQUEST PAYOUT --}}
    <div class="modal fade" id="requestPayout" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestPayoutTitle">Request Payout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="payout_form" action="{{ route('organizations.payout.request', ['organization' => $organization -> id]) }}" method="post">
                        @csrf

                        <div class="form-floating">
                            <input class="form-control" type="number" name="amount" id="payout_amount_id"
                                placeholder="Enter Payout Amount" max="{{ $organization->wallet_balance }}">
                            <label for="floatingTextarea2">Payout Amount</label>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#payout_form').submit()">Save
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
                        action="{{ route('organizations.payment.update', ['organization' => $organization->id]) }}"
                        method="post">
                        @csrf

                        <div class="form-floating m-3">
                            <input class="form-control" placeholder="Enter Bank Detail" type="text" name="bank_name"
                                id="bank_name_id"
                                value="{{ $organization->organization_payment_information? $organization->organization_payment_information->bank_name: '' }}">
                            <label for="bank_name_id">Enter Bank Name</label>
                        </div>
                        <div class="form-floating m-3">
                            <input class="form-control" placeholder="Enter Bank Account Number" type="text"
                                name="bank_account_number" id="bank_account_number_id"
                                value="{{ $organization->organization_payment_information? $organization->organization_payment_information->bank_account_number: '' }}">
                            <label for="bank_name_id">Enter Bank Account Number</label>
                        </div>
                        <div class="form-floating m-3">
                            <input class="form-control" placeholder="Enter IFSC Code" type="text" name="ifsc" id="ifsc_id"
                                value="{{ $organization->organization_payment_information ? $organization->organization_payment_information->ifsc : '' }}">
                            <label for="bank_name_id">Enter IFSC Code</label>
                        </div>
                        <div class="form-floating m-3">
                            <input class="form-control" placeholder="Enter UPI ID" type="text" name="upi_id" id="upi_id"
                                value="{{ $organization->organization_payment_information? $organization->organization_payment_information->upi_id: '' }}">
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
