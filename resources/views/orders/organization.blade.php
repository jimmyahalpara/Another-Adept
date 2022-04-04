@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceIndex" class="bg-image d-flex justify-content-center align-items-center"
            style="
                                                                                                                                    background-image: url('{{ asset('assets/images/firstImage.jpg') }}');">
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

            <div class="d-flex justify-content-center align-items-center">
                <span class="w-25 num-rows-label">
                    Num Rows:
                </span>
                <select name="num_rows" id="num_rows" class="form-control m-1">
                    <option value="10" @if ($num_rows == 10) selected @endif>10</option>
                    <option value="20" @if ($num_rows == 20) selected @endif>20</option>
                    <option value="50" @if ($num_rows == 50) selected @endif>50</option>
                    <option value="100" @if ($num_rows == 100) selected @endif>100</option>
                    <option value="200" @if ($num_rows == 200) selected @endif>200</option>
                </select>
            </div>

        </div>

        <table class="table table-striped">
            <tr>
                <th>Order ID</th>
                <th>Service ID</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Area</th>
                <th>Service Name</th>
                <th>Price</th>
                <th>Created At </th>
                <th>Status</th>
                <th>Comment</th>
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
                    <td>{{ $order->comment }}</td>
                    <td>
                        <div class="dropdown">
                            <i class="fas fa-ellipsis-v px-2" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            </i>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item"
                                        onclick="@if ($order->service->areas->contains($user->area_id)) assign({{ $order->id }}) @else assign({{ $order->id }}, true) @endif">Assign</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Cancel</a></li>
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
                    <h6 id="order-user-name">
                        User Name
                    </h6>

                    <h6>
                        Order Service Name
                    </h6>

                    <div id="order-service-areas">
                        Service Areas
                    </div>
                    <div class="form-floating">
                        <select name="member_id" class="form-control" id="member_id">
                            <option value="">Select Member</option>
                            @foreach ($members as $member)
                                <option value="{{ $member -> id }}">{{ $member -> user -> name }} - {{ $member -> user -> email }}</option>
                            @endforeach
                        </select>
                        <label for="member_id">Select Member</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
                })
            } else {
                showAssignDialog(order_id)
            }
        }


        function showAssignDialog(order_id){
            var myModal = new bootstrap.Modal(document.getElementById('assignProvider'))
            myModal.show(300);
        }
    </script>
@endsection
