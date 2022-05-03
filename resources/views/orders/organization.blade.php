@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceOrders" class="w-100 bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/background (5).jpg') }}'); background-position: 0% 50%">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0);">
                <h1 style="color: white; text-shadow: 0px 0px 10px black">All Orders</h1>
                <h3 style="color: white; text-shadow: 0px 0px 10px black">{{ Auth::user()->get_organization()->name }}</h3>
            </div>
        </div>
    </section>

    <main class="p-3 px-3" style="width: 98vw; overflow-x: scroll; overflow-y:visible">
        <div class="links m-1 d-flex align-items-center justify-content-between">
            <div>
                {{ $orders->links() }}
            </div>

            <div class="d-flex justify-content-center align-items-center w-50">
                {{-- <form action="" class="me-3">
                    <input type="search" name="search_text" class="form-control me-3 w-100" placeholder="Search" value="{{ $search_text }}">
                </form> --}}
                <span class="num-rows-label">
                    Num Rows:
                </span>
                <select name="num_rows" id="num_rows" class="form-control m-1 w-25">
                    <option value="5" @if ($num_rows == 5) selected @endif>5</option>
                    <option value="10" @if ($num_rows == 10) selected @endif>10</option>
                    <option value="20" @if ($num_rows == 20) selected @endif>20</option>
                    <option value="50" @if ($num_rows == 50) selected @endif>50</option>
                    <option value="100" @if ($num_rows == 100) selected @endif>100</option>
                    <option value="200" @if ($num_rows == 200) selected @endif>200</option>
                </select>
            </div>

        </div>
        @if (!$errors->isEmpty())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span><br>
                @endforeach
            </div>
        @endif
        <table class="table table-striped">
            <tr>
                <th>@sortablelink('id', 'Order ID')</th>
                <th>@sortablelink('service_id', 'Service ID')</th>
                <th>@sortablelink('user.name', 'User Name')</th>
                </th>
                <th>@sortablelink('user.email', 'User Email')</th>
                <th>User Area</th>
                <th>@sortablelink('service.name', 'Service Name')</th>
                <th>@sortablelink('service.price', 'Price')</th>
                <th>@sortablelink('created_at', 'Created At')</th>
                <th>@sortablelink('order_state_id', 'Status')</th>
                <th>Assigned To / Status</th>
                <th>Comment</th>
                <th>Reasons</th>
                <th>Invoices</th>
                <th>Action</th>
            </tr>
            @forelse ($orders as $order)
                @php
                    $user = $order->user;
                    if (!$user) {
                        continue;
                    }
                @endphp
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->service->id }}</td>
                    <td>
                        <a href="#" onclick="showUserDetail({{ $order->id }})">
                            {{ $user->name }}
                        </a>
                    </td>
                    </a>
                    <td>{{ $user->email }}</td>
                    <td>


                        <span class="badge @if ($order->service->areas->contains($user->area_id)) bg-success @else bg-danger @endif">
                            {{ $user->area->city->name }} - {{ $user->area->name }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('services.show', ['service' => $order->service->id]) }}">
                            {{ $order->service->name }}
                        </a>
                    </td>
                    <td>
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                        <b>
                            {{ $order->service->price }}
                        </b>
                        / {{ $order->service->price_type->name }}
                    </td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->order_state->name }}</td>
                    <td>
                        @if ($order->order_member && $order -> order_member -> user_organization_membership -> user)
                            {{ $order->order_member->user_organization_membership->user->name }} /
                            <span class="badge @if ($order->order_member->order_member_state_id == 1) bg-danger @else bg-success @endif">
                                {{ $order->order_member->order_member_state->name }}
                            </span>
                        @endif
                    </td>
                    <td>{{ $order->comment }}</td>
                    <td>
                        <table class="table table-bordered table-primary">
                            @foreach ($order->reasons as $reason)
                                <tr>
                                    <td>
                                        {{ $reason->body }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                    <td>
                        @foreach ($order->invoices as $invoice)
                            <span class="badge @if ($invoice->invoice_state_id == 1) bg-danger @else bg-success @endif">
                                {{ $invoice->invoice_state->name }}
                            </span>
                        @endforeach
                    </td>
                    <td>
                        <div class="dropdown">
                            <i class="fas fa-ellipsis-v px-2" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            </i>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item"
                                        onclick="@if ($order->service->areas->contains($user->area_id)) assign({{ $order->id }}); @else assign({{ $order->id }}, true); @endif">Assign</a>
                                </li>
                                <li><a class="dropdown-item" onclick="cancelOrder({{ $order->id }})">Cancel</a></li>
                                <li><a class="dropdown-item" onclick="rejectOrder({{ $order->id }})">Reject</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('order.invoice.create', ['service_order' => $order->id]) }}">Generate
                                        Invoice</a></li>

                                @if ($order->order_state_id != 3 && $order->order_state_id != 4 && $order->order_state_id != 5)
                                    @if ($order->order_state_id != 6)
                                        <li><a class="dropdown-item"
                                                onclick="completeOrder({{ $order->id }}, 6)">Complete</a></li>
                                    @else
                                        <li><a class="dropdown-item" onclick="completeOrder({{ $order->id }}, 2)">In
                                                Complete</a></li>
                                    @endif
                                @endif
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="#">Report</a></li>
                            </ul>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td>No Orders</td>
                </tr>
            @endforelse
        </table>
    </main>


    <div class="modal fade" id="assignProvider" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignProviderLabel">Assign Order To</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <b>Name: </b>
                    <h6 id="order-user-name">
                        User Name
                    </h6>

                    <b>Service Name: </b>
                    <h6 id="order-service-name">
                        Order Service Name
                    </h6>

                    <b>Area: </b>
                    <div id="order-service-areas">
                        Service Areas
                    </div>

                    <b>Comments: </b>
                    <div id="order-service-comment">
                        Service Comment
                    </div>
                    <form action="{{ route('order.assign') }}" method="post" id="assignOrder">
                        @csrf
                        <input type="hidden" name="order_id" id="order_id" value="">
                        <div class="mt-5 form-floating">
                            <select name="member_id" class="form-control" id="member_id">
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">
                                        {{ $member->user->area->city->name }}-{{ $member->user->area->name }}
                                        -- {{ $member->user->name }}</option>
                                @endforeach
                            </select>
                            <label for="member_id">Select Member</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#assignOrder').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="cancelMessage" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignProviderLabel">Cancel Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('order.cancel') }}" method="post" id="cancelOrder">
                        @csrf
                        <input type="hidden" name="order_id" id="cancel_order_id" value="">
                        <div class="mt-5 form-floating">
                            <input class="form-control" type="text" name="reason" id="cancel_reason_id"
                                placeholder="Enter Cancellation Reason" maxlength="100">
                            <label for="cancel_reason_id">Enter Cancellation Reason</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#cancelOrder').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="rejectMessage" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignProviderLabel">Reject Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('order.reject') }}" method="post" id="rejectOrder">
                        @csrf
                        <input type="hidden" name="order_id" id="reject_order_id" value="">
                        <div class="mt-5 form-floating">
                            <input class="form-control" type="text" name="reason" id="reject_reason_id"
                                placeholder="Enter Rejection Reason" maxlength="100">
                            <label for="reject_reason_id">Enter Rejection Reason</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#rejectOrder').submit()">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    {{-- User Details --}}
    <div class="modal fade" id="showDetails" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showDetailsLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <b>Name: </b>
                    <h6 id="detail-order-user-name">
                        Loading ..
                    </h6>

                    <b>Service Name: </b>
                    <h6 id="detail-order-service-name">
                        Loading ..
                    </h6>

                    <b>User Address </b>
                    <h6 id="detail-order-user-address">
                        Loading ..
                    </h6>

                    <b>Area: </b>
                    <div id="detail-order-service-areas">
                        Loading ..
                    </div>

                    <b>Comments: </b>
                    <div id="detail-order-service-comment">
                        Loading ..
                    </div>

                    <b>User Email: </b>
                    <div id="detail-order-user-email">
                        Loading ..
                    </div>

                    <b>User Phone: </b>
                    <div id="detail-order-user-phone">
                        Loading ..
                    </div>

                    <b>Generated Invoices</b>
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Amount</th>
                                    <th>Amount Paid</th>
                                    <th>Due Date</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Description</th>
                                    <th>Invoice State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="showDetailsInvoice">
                                <tr>
                                    <td>ID</td>
                                    <td>Amount</td>
                                    <td>Amount Paid</td>
                                    <td>Due Date</td>
                                    <td>Created At</td>
                                    <td>Updated At</td>
                                    <td>Description</td>
                                    <td>Invoice State</td>
                                    <td>
                                        <a href="">
                                            <i class="fa-solid fa-circle-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary" >Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('order.complete') }}" method="post" id="complete_order_form">
        @csrf
        <input type="hidden" name="order_state_id" id="order_state_id" value="2">
        <input type="hidden" name="service_order_id" id="service_order_id" value="0">
    </form>

    <script>
        $("#num_rows").on('change', function(e) {
            value = this.value;

            url = new URL(window.location.href);
            url.searchParams.set('num_rows', value);
            url.searchParams.set('page', 1);
            document.location = url.href;
        });


        function assign(order_id, show_warning = false) {
            if (show_warning) {
                Swal.fire({
                    title: 'Requesting user area is not covered by your service. Do you still want to continue?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Continue',
                    denyButtonText: `No`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        showAssignDialog(order_id);
                    } else if (result.isDenied) {
                        Swal.fire(
                            'You can reject the Order from your side as the user area is not covered by your service',
                            '', 'info')
                    }
                });
            } else {
                showAssignDialog(order_id)
            }
        }

        // assign Order
        function showAssignDialog(order_id) {
            var myModal = new bootstrap.Modal(document.getElementById('assignProvider'))

            $.get({
                url: "{{ route('order.details') }}",
                data: {
                    order_id: order_id
                },
                success: function(response) {
                    $('#order-user-name').html(response.user.name);
                    $('#order-service-name').html(response.service.name);
                    $('#order-service-areas').html(response.user.area.city.name + " - " + response.user.area
                        .name);
                    $('#order-service-comment').html(response.comment);
                    $('#order_id').val(order_id);
                    myModal.show(300);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }


        // CANCEL ORDER
        function cancelOrder(order_id) {
            var myModal = new bootstrap.Modal(document.getElementById('cancelMessage'));

            Swal.fire({
                title: 'Do You Really want to cancel this order ?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $('#cancel_order_id').val(order_id);
                    myModal.show(300)
                }
            });
        }


        // REJECT ORDER
        function rejectOrder(order_id) {
            var myModal = new bootstrap.Modal(document.getElementById('rejectMessage'));

            Swal.fire({
                title: 'Do You Really want to reject this order ?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $('#reject_order_id').val(order_id);
                    myModal.show(300)
                }
            });
        }


        function showUserDetail(order_id) {
            var myModal = new bootstrap.Modal(document.getElementById('showDetails'));
            myModal.show(300);
            $.get({
                url: "{{ route('order.details') }}",
                data: {
                    order_id: order_id
                },
                success: function(response) {
                    $('#detail-order-user-name').html(response.user.name);
                    $('#detail-order-service-name').html(response.service.name);
                    $('#detail-order-service-areas').html(response.user.area.city.name + " - " + response.user
                        .area
                        .name);
                    $('#detail-order-service-comment').html(response.comment);
                    $('#detail-order-user-email').html(response.user.email);
                    $('#detail-order-user-phone').html(response.user.phone_number);
                    $('#detail-order-user-address').html(response.user.address);

                    $('#showDetailsInvoice').html('');

                    response.invoices.forEach(invoice => {
                        // convert invoice.created_at to datetime 
                        var date = new Date(invoice.created_at);
                        var created_at_datetime = date.getDate() + '/' + (date.getMonth() + 1) + '/' +
                            date.getFullYear() + ' ' +
                            date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();


                        // do same for updated_at
                        var date = new Date(invoice.updated_at);
                        var updated_at_datetime = date.getDate() + '/' + (date.getMonth() + 1) + '/' +
                            date.getFullYear() + ' ' +
                            date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
                        
                        // do same for due
                        // console.log(invoice.due);
                        if (invoice.due != null){
                            var date = new Date(invoice.due);
                            console.log(date);
                            var due = date.getDate() + '/' + (date.getMonth() + 1) + '/' +
                                date.getFullYear() + ' ' +
                                date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
                        } else {
                            var due = '-';
                        }

                        // append invoice to invoice table 
                        // background color light orange if invoice.invoice_state_id is 1 and due date has passed 
                        bg_color = "";
                        if (invoice.invoice_state_id == 1) {
                            var date = new Date(invoice.due);
                            if (date < new Date()) {
                                bg_color = "bg-warning";
                            }
                        }
                        $('#showDetailsInvoice').append(`
                            <tr class="${bg_color}">
                                <td>${invoice.id}</td>
                                <td>${invoice.amount}</td>
                                <td>${invoice.amount_paid}</td>
                                <td>${due}</td>
                                <td>${created_at_datetime}</td>
                                <td>${updated_at_datetime}</td>
                                <td>${invoice.description}</td>
                                <td>${invoice.invoice_state.name}</td>
                                <td>
                                    <form action="{{ route('invoice.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="invoice_id" value="${invoice.id}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                
                            </tr>
                        `);


                    });


                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        function completeOrder(order_id, state_id) {
            $('#order_state_id').val(state_id);
            $('#service_order_id').val(order_id);



            Swal.fire({
                title: 'Do you want to change state of this order?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {

                    $('#complete_order_form').submit();
                }
            });


        }
    </script>
@endsection
