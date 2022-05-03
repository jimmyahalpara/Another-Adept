@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceOrders" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/background (5).jpg') }}'); background-position: 0% 50%">
            <div class="mask d-flex justify-content-center align-items-center flex-column"
                style="background-color: rgba(250, 182, 162, 0);">
                <h1 style="color: white; text-shadow: 0px 0px 10px black">My Services</h1>
                <h3 style="color: white; text-shadow: 0px 0px 10px black">{{ Auth::user()->get_organization()->name }}</h3>
            </div>
        </div>
    </section>

    <main class="p-3 px-3">
        <div class="links m-1 d-flex align-items-center justify-content-between">
            <div>
                {{ $member_orders->links() }}
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
                <th>@sortablelink('service_order_id', 'Order ID')</th>
                <th>@sortablelink('service_order.service_id', 'Service ID')</th>
                <th>User Name</th>
                </th>
                <th>User Email</th>
                <th>User Area</th>
                <th>Service Name</th>
                <th>Service Price</th>
                <th>@sortablelink('service_order.created_at', 'Created At')</th>
                <th>@sortablelink('order_member_state_id', 'Status')</th>
                <th>Comment</th>
                <th>Reasons</th>
                <th>Invoices</th>
                <th>Action</th>
            </tr>
            @forelse ($member_orders as $ord)
                @php
                    $order = $ord->service_order;
                    
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
                    <td>{{ $user->email }}</td>
                    <td>


                        <span class="badge @if ($order->service->areas->contains($user->area_id)) bg-success @else bg-danger @endif">
                            {{ $user->area->city->name }} - {{ $user->area->name }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('search.show', ['service' => $order->service->id]) }}">
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
                    <td>
                        <span class="badge @if ($ord -> order_member_state_id == 1) bg-danger @else bg-success @endif">
                            {{ $ord->order_member_state->name }}
                        </span>
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
                                <li>
                                    @if ($ord -> order_member_state_id == 1)
                                        <a class="dropdown-item"
                                            onclick="changeOrderMemberState({{ $ord->id }},2)">Complete</a>
                                    @else
                                        <a class="dropdown-item"
                                            onclick="changeOrderMemberState({{ $ord->id }},1)">In Complete</a>
                                    @endif
                                </li>
                                <div class="dropdown-divider">

                                </div>
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

    <div class="modal fade" id="showDetails" tabindex="-1">
        <div class="modal-dialog">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('order.assigned.state.change') }}" method="post" id="change_order_form">
        @csrf
        <input type="hidden" id="order_member_id" name="order_member_id" value="0">
        <input type="hidden" id="order_member_state_id" name="order_member_state_id" value="0">
    </form>

    <script>
        $("#num_rows").on('change', function(e) {
            value = this.value;

            url = new URL(window.location.href);
            url.searchParams.set('num_rows', value);
            url.searchParams.set('page', 1);
            document.location = url.href;
        });

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
                    
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }



        function changeOrderMemberState(order_member_id, order_member_state_id) {
            Swal.fire({
                title: 'Do You Really want to change the state?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#order_member_id').val(order_member_id);
                    $('#order_member_state_id').val(order_member_state_id);
                    $('#change_order_form').submit();
                }
            });
        }
    </script>


@endsection
