@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceSearch" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column" style="">
                <h1>My Invoices</h1>

            </div>
        </div>
    </section>
    <main class="p-3">
            <div class="col-lg-10 p-1" id="main-service-container">
                @foreach ($invoices as $invoice)
                    <div class="border m-3 row">
                        <div class="col-lg-2 p-2">
                            <b>Invoice #{{ $invoice->id }}</b>
                            <div>{{ $invoice->created_at }}</div>
                        </div>
                        <div class="col-lg-2 p-2">
                            <b>Due</b>
                            <div>{{ $invoice->due }}</div>
                        </div>
                        <div class="col-lg-2 p-2">
                            <b>Service Name</b>
                            <div>{{ $invoice->service_order -> service->name }}</div>
                        </div>
                        <div class="col-lg-2 p-2">
                            <b>Amount</b>
                            <div>{{ $invoice->amount }}</div>
                        </div>
                        <div class="col-lg-1 p-2">
                            <b>Status</b><br>
                            @if ($invoice -> invoice_state_id == 1)
                                <span class="badge bg-danger">
                                    {{ $invoice->invoice_state -> name }}
                                </span>
                            @else
                            <span class="badge bg-success">
                                {{ $invoice->invoice_state -> name }}
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-2 p-2 d-flex justify-content-center align-items-center">
                            <button class="btn btn-success">Pay</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="m-1 d-flex justify-content-center align-items-center">
                {{ $invoices->links() }}
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

        
    </script>
@endsection
