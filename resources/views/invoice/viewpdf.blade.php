<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill - {{ $invoice -> id }}</title>
    
    <style>
        table {
            border-collapse: collapse;
        }

        td,th {
            padding: 10px 60px;
            border: 1px solid rgba(0, 0, 0, 0.363)
        }
        body {
            font-family: "Karla", sans-serif;
            /* background-color: #d0d0ce; */
        }

        #main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column
        }

        table {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="" id="main-container">
        <h1>Invoice #4</h1>
        <table class="table-bordered w-50">
            @php
                $user = $invoice -> service_order -> user;
            @endphp
            <tr>
                <th>Invoice ID </th>
                <td>{{ $invoice -> id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $user -> name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user -> name }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $user -> address }}</td>
            </tr>
            <tr>
                <th>Area</th>
                {{-- @dd($user -> area) --}}
                <td>{{ $user -> area -> city -> name }} - {{ $user -> area  -> name }}</td>
            </tr>
            <tr>
                <th>Service Order ID</th>
                <td>{{ $invoice -> service_order -> id }}</td>
            </tr>
            <tr>
                <th>Service ID</th>
                <td>{{ $invoice -> service_order -> service -> id }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>₹ {{ $invoice -> service_order -> service -> price }}</td>
            </tr>
            <tr>
                <th>
                    Service Status
                </th>
                <td>Status</td>
            </tr>
            <tr>
                <th>Service Ordered At</th>
                <td>some time</td>
            </tr>
            <tr>
                <th>Invoice Generated At</th>
                <td>some Time</td>
            </tr>
            <tr>
                <th>Invoice Amount</th>
                <td>123123</td>
            </tr>
        </table>
        <h2>Transactions</h2>
        <table>
            
        </table>
    </div>
</body>
</html>