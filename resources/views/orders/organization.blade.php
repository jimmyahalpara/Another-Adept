@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0.15);">
                <h1>All Orders</h1>
                <h3>{{ Auth::user()->get_organization()->name }}</h3>
            </div>
        </div>
    </section>

    <main class="p-3 px-5">
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
                <th>@sortablelink('user.id', 'User ID')</th>
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
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>


                        <span class="badge @if ($order->service->areas->contains($user->area_id)) bg-success @else bg-danger @endif">
                            {{ $user->area->city->name }} - {{ $user->area->name }}
                        </span>
                    </td>
                    <td>
                        <a href="#">
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
                        @if ($order->order_member)
                            {{ $order->order_member->user_organization_membership->user->name }} /
                            <span class="badge bg-danger">
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
                        Invoices
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
                                <li><a class="dropdown-item" onclick="generateInvoice({{ $order->id }})">Generate Invoice</a></li>
                                <div class="dropdown-divider">

                                </div>
                                <li><a class="dropdown-item" href="#">Report</a></li>
                            </ul>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td>No members Available</td>
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
                            <label for="reject_reason_id">Enter Rrejection Reason</label>
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
    </script>
@endsection
