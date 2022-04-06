@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceSearch" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image url('{{ asset('assets/images/pinkCity1.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column" style="">
                <h1>Create Invoice</h1>

            </div>
        </div>
    </section>
    <main class="p-3">
        <div class="d-flex justify-content-center align-items-center flex-column">
            @if (!$errors->isEmpty())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br>
                    @endforeach
                </div>
            @endif
            <div class="invoice-container w-50">
                <table class="table table-bordered w-100">
                    <tr>
                        <th>Name </th>
                        <td>{{ $service_order->user->name }}</td>
                    </tr>
                    <tr>
                        <th>User Email </th>
                        <td>{{ $service_order->user->email }}</td>
                    </tr>
                    <tr>
                        <th>User Phone </th>
                        <td>{{ $service_order->user->phone_number }}</td>
                    </tr>
                    <tr>
                        <th>Address </th>
                        <td>{{ $service_order->user->address }}</td>
                    </tr>
                    <tr>
                        <th>Area </th>
                        <td>{{ $service_order->user->area->city->name }} -
                            {{ $service_order->user->area->name }}</td>
                    </tr>
                    <tr>
                        <th>Service Name </th>
                        <td>{{ $service_order->service->name }}</td>
                    </tr>
                    <tr>
                        <th>Service Price Type </th>
                        <td>{{ $service_order->service->price_type->name }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>
                            <form action="{{ route('order.invoice.store', ['service_order' => $service_order->id]) }}"
                                method="post" id="invoice-form">
                                @csrf

                                <input type="number" name="amount" id="amount" placeholder="Enter Price"
                                    class="form-control" value="{{ $service_order->service->price }}">

                                

                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th>Description: </th>
                        <td>
                            <textarea name="description" id="description_id" cols="30" rows="10"
                                placeholder="Enter Some Description (e.g Price Distribution)" class="form-control"
                                form="invoice-form" maxlength="200"></textarea>
                        </td>
                    </tr>
                </table>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-success" type="submit" form="invoice-form">Generate</button>
                </div>
            </div>
        </div>
    </main>
@endsection
