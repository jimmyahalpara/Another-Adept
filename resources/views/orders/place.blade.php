@extends('layouts.app')


@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/homestyle.css') }}">
    <section>
        <!-- Intro -->
        <div id="introServiceSearch" class="bg-image d-flex justify-content-center align-items-center"
            style="background-image: url('{{ asset('assets/images/pinkCity1.jpg') }}');">
            <div class="mask d-flex justify-content-center align-items-center flex-column" style="">
                <h1>Services</h1>

            </div>
        </div>
    </section>
    <main class="p-3">
        <div class="orderContainer row m-1">
            <div id="orderDetailContainer" class="col-lg-8">
                <h1>{{ $service->name }}</h1>
                <div class="service-details ps-2">
                    <h6>
                        <i class="fa-solid fa-building"></i>
                        <a href="" class="mx-1 link-heading">
                            {{ $service->organization->name }}
                        </a>
                    </h6>
                    <h6>
                        <i class="fa-solid fa-tag"></i>
                        <a href="" class="mx-1 link-heading">
                            {{ $service->service_category->name }}
                        </a>
                    </h6>
                    <h6>
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                        {{ $service->price }} - {{ $service->price_type->name }}
                        @if ($service->price_type->id == config('appconfig.variable_pricetype_id'))
                            <em class="text-danger ms-1">
                                Cost is variable, means that amount which you'll have to pay will depend on your
                                requirements of the service. It will be decided later by the Provider / Organization
                            </em>
                        @endif
                    </h6>
                    <h6>
                        <i class="fa-solid fa-location-dot"></i>
                        @forelse ($service -> areas as $area)
                            <span class="badge @if ($user->area_id == $area->id) bg-success @else bg-dark @endif">
                                {{ $area->city->name }} - {{ $area->name }}
                            </span>
                        @empty
                        @endforelse
                    </h6>
                </div>
                <h1>User Details</h1>
                <small class="small-text">
                    Following details will be provided to the organization in order to fullfill your service.
                </small>
                <div class="m-1">
                    <button class="buttonRounded px-3 py-2">
                        <i class="fa-solid fa-pencil"></i>
                        Edit Details
                    </button>
                </div>
                <div class="user-details ps-2 pt-2">
                    <h6>
                        <i class="fa-solid fa-user"></i>
                        <span class="mx-1">
                            {{ $user->name }}
                        </span>
                    </h6>
                    <h6>
                        <i class="fa-solid fa-at"></i>
                        <span class="mx-1">
                            {{ $user->email }}
                        </span>
                    </h6>
                    <h6>
                        <i class="fa-solid fa-phone"></i>
                        <span class="mx-1">
                            {{ $user->phone_number }}
                        </span>
                    </h6>
                    <h6>
                        <i class="fa-solid fa-location-dot"></i>
                        <span class="mx-1">
                            {{ $user->area->city->name }} - {{ $user->area->name }}
                            <span class="ms-1 text-danger">
                                @if (!$service->areas->contains($user ? $user->area_id : 0))
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    Not Available in your area. Provider May regect Your Order.
                                @endif
                            </span>
                        </span>
                    </h6>
                    <h6>
                        <i class="fa-solid fa-map-pin"></i>
                        <span class="mx-1">
                            {{ $user->address }}
                        </span>
                    </h6>
                    <form id="submit-form" action="{{ route('order.confirm', ['service' => $service->id]) }}"
                        method="post">
                        @csrf
                        <textarea placeholder="Any Additional Comments (optional)" name="comment" id="comment" cols="30" rows="10"
                            class="form-control" maxlength="200"></textarea>
                    </form>
                </div>

            </div>
            <div class="orderSummaryContainer col-lg-4 ">
                <div id="order-summary-id" class="p-4">
                    <h2>Summary</h2>
                    <table class="w-100">
                        <tr>
                            <th>Service Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td>x1</td>
                            <td>
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                {{ $service->price }} / {{ $service->price_type->name }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Total Price: </th>
                            <th>
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                <span id="amount">
                                    {{ $service->price }}
                                </span>
                                /-
                            </th>
                        </tr>
                    </table>
                    <button onclick="$('#submit-form').submit()" class="btn btn-success w-100">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </main>
@endsection
