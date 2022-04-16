@extends('beautymail::templates.minty')

@section('heading')
    Service Adept
@endsection

@section('content')

    @include('beautymail::templates.minty.contentStart', [
        'text' => 'Service Adept',
    ])
    <tr>
        <td class="title">
            Hello, {{ $invoice->service_order->user->name }}
        </td>
    </tr>
    <tr>
        <td width="100%" height="10"></td>
    </tr>
    <tr>
        <td class="paragraph">
            Invoice for your order of service {{ $invoice->service_order->service->name }} has been generated of amount Rs. {{ $invoice->amount }}.
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    <tr id="table-container-row">
        <table id="detail-table">
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
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    <tr>
        <td class="paragraph">
            <small>
                Regards,<br>
                Service Adept Help Desk.
            </small>
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    <tr>
        <td class="paragraph">
            <small>
                Need Help ? <a href="{{ config('appconfig.help_email') }}"> Mail Us.</a>
            </small>
        </td>
    </tr>
    <style>
        th,
        td {
            padding: 1vh 1vw;
            
        }

        #table-container-row {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        #table-container-row td,
        #table-container-row th {
            border: 1px solid #ddd;
            padding: 1vh 1vw;
        }

        #detail-table {
            width: 100%;
            border-collapse: collapse;
        }

    </style>
    @include('beautymail::templates.minty.contentEnd')

@stop
