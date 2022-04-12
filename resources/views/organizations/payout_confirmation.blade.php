@extends('voyager::master')

@section('content')
<style>
    td,th {
        padding: 1vh 2vh;
        border: 1px solid rgba(0, 0, 0, 0.457)
    }
</style>
    <div style="padding: 5vh; display: flex; justify-content: center; align-items: center; flex-direction: column">
        <div style="width: 100%; display: flex; justify-content: center; align-items: center; flex-direction: column">
            <table style="border: 1px solid rgba(0, 0, 0, 0.245); border-collapse: collapse">
                <tr>
                    <th>Organization Name </th>
                    <td>{{ $payout -> organization -> name }}</td>
                </tr>
                <tr>
                    <th>Request Amount </th>
                    <td>Rs. {{ $payout -> amount }}</td>
                </tr>
                <tr>
                    <th>Organization Wallet Balance</th>
                    <td>Rs. {{ $payout -> organization -> wallet_balance }}</td>
                </tr>
                <tr>
                    <th>Organization Bank </th>
                    <td>{{ $payout -> organization -> organization_payment_information -> bank_name }}</td>
                </tr>
                <tr>
                    <th>Account Account Number</th>
                    <td>{{ $payout -> organization -> organization_payment_information -> bank_account_number }}</td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td>{{ $payout -> organization -> organization_payment_information -> ifsc }}</td>
                </tr>
                <tr>
                    <th>UPI ID</th>
                    <td>{{ $payout -> organization -> organization_payment_information -> upi_id }}</td>
                </tr>
            </table>
        </div>
        <form action="{{ route('organizations.payout.confirmation.post', ['payout' => $payout -> id]) }}"
            method="post" class="d-flex justify-content-center align-items-center">
            @csrf
            <h1>Do You want to accept this request ?</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="text" placeholder="Enter Reason if you select No below." name="reason"
                style="width: 100%; padding: 2vh">
            <div style="display: flex; justify-content: center; align-items: center; flex-direction: row">
                <button name="submit" type="submit" class="btn btn-success" value="accept">
                    Yes
                </button>
                <button name="submit" type="submit" style="margin-left: 2vw" class="btn btn-danger" value="reject">
                    No
                </button>
            </div>

        </form>
        
    </div>

@endsection
