<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill - {{ $invoice->id }}</title>

    <style>
        table {
            border-collapse: collapse;
        }

        td,
        th {
            /* padding: 10px 60px; */
            border: 1px solid rgba(122, 122, 122, 0.252)
        }

        #detail-table {
            margin: 0 auto;
        }
        #detail-table td, #detail-table th {
            padding: 8px 40px
        }

        body {
            font-family: "Karla", sans-serif;
            font-size: 0.9em
        }

        #main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* border: 1px solid black */
        }

        #payment-table {
            font-size: 0.8em
        }

    </style>
</head>

<body>
    <div class="" id="main-container">
        <h1 style="margin-bottom: 0">Invoice #4</h1>
        <small style="padding-bottom: 10px"><i>{{ now() }}</i></small>
        <table  id="detail-table" class="table-bordered w-50">
            @php
                $user = $invoice->service_order->user;
            @endphp
            <tr>
                <th>Invoice ID </th>
                <td>{{ $invoice->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $user->address }}</td>
            </tr>
            <tr>
                <th>Area</th>
                {{-- @dd($user -> area) --}}
                <td>{{ $user->area->city->name }} - {{ $user->area->name }}</td>
            </tr>
            <tr>
                <th>Service Order ID</th>
                <td>{{ $invoice->service_order->id }}</td>
            </tr>
            <tr>
                <th>Service ID</th>
                <td>{{ $invoice->service_order->service->id }}</td>
            </tr>
            <tr>
                <th>Service Name</td>
                <td>{{ $invoice->service_order->service->name }}</td>
            </tr>
            <tr>
                <th>Service Category</th>
                <td>{{ $invoice->service_order->service->service_category->name }}</td>
            </tr>
            <tr>
                <th>Organization</th>
                <td>{{ $invoice->service_order->service->organization->name }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>Rs. {{ $invoice->service_order->service->price }} /
                    {{ $invoice->service_order->service->price_type->name }}</td>
            </tr>
            <tr>
                <th>
                    Service Order State
                </th>
                <td>
                    {{ $invoice->service_order->order_state->name }}
                    <i>
                        at {{ $invoice->service_order->updated_at }}
                    </i>
                </td>
            </tr>
            <tr>
                <th>Service Ordered At</th>
                <td>{{ $invoice->service_order->created_at }}</td>
            </tr>
            <tr>
                <th>Invoice Generated At</th>
                <td>{{ $invoice->created_at }}</td>
            </tr>
            <tr>
                <th>Invoice Amount</th>
                <td>Rs. {{ $invoice->amount }} /-</td>
            </tr>
            <tr>
                <th>Invoice Due Date</th>
                <td>{{ $invoice->due }}</td>
            </tr>
        </table>
        <h2>Payments</h2>
        <table id="payment-table" style="width: 700px; margin: 0 auto;">
            <tr>
                <th>Transaction ID</th>
                <th>Invoice ID</th>
                <th>Order Id</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment Method</th>
                <th>Initiated At</th>
                <th>Finished At</th>
            </tr>
            @forelse ($invoice->payments as $payment)
                <tr>
                    <td>{{ $payment->transaction_id }}</td>
                    <td>{{ $payment->invoice_id }}</td>
                    <td>{{ $payment->order_id }}</td>
                    <td>Rs. {{ $payment->amount }}</td>
                    <td>
                        @if ($payment -> status == 0)
                            Failed
                        @else
                            Paid
                        @endif
                    </td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->created_at }}</td>
                    <td>{{ $payment->updated_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        No Payments Done Yet
                    </td>
                </tr>
            @endforelse
        </table>
        <table>

        </table>
    </div>
</body>

</html>
{{-- @dd() --}}