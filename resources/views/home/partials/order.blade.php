<div class="m-1 my-4 row service-container-orders" id="service-partial-{{ $service->id }}">
    <div class="service-image-container-orders col-lg-3 d-flex justify-content-center align-items-center">
        <img class="service-image" src="{{ $service->images->first()->image_path }}" alt="">
    </div>
    <div class="col-9 p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="small-text">
                <a class="link-heading"
                    href="{{ route('search', ['organization_filter' => [$service->organization->id], 'areas' => []]) }}">
                    {{ $service->organization->name }}
                </a>
            </div>

        </div>
        <a class="link-heading">
            <a href="{{ route('search.show', ['service' => $service->id]) }}" class="link-heading">
                <div class="big-text">{{ $service->name }}</div>
            </a>
        </a>
        <div class="row">
            <span class=" col-lg-3">
                ₹
                @if ($service->price_type_id != config('appconfig.variable_pricetype_id'))
                    {{ $service->price }} -
                @endif
                {{ $service->price_type->name }}
            </span>
            <span class="col-lg-2">
                <i class="fa-solid fa-tag"></i>
                <a class="link-heading"
                    href="{{ route('search', ['categories_filter' => [$service->service_category->id]]) }}">
                    {{ $service->service_category->name }}
                </a>
            </span>
        </div>

        <div class="mt-2 py-3 d-flex justify-content-start align-items-center">
            <div class="col-lg-2 d-flex justify-content-start align-items-center">


                @if ($order->order_state_id == 2 || $order -> order_state_id == 1)
                    <form action="{{ route('home.cancel') }}" method="post" onsubmit="return confirm('Do You Want to Cancel This Order?')">
                        @csrf
                        <input type="hidden" name="service_order_id" value="{{ $order -> id }}">

                        <button type="submit" class="btn btn-success">Cancel</button>
                    </form>
                @endif



                @if ($user && $user->services->contains($service->id))
                    <i id="like-button-{{ $service->id }}" class="cart-button ps-3 text-danger fa-solid fa-heart"
                        onclick="like_clicked({{ $service->id }} @if (!$service->areas->contains($user ? $user->area_id : 0)) ,true @endif)"></i>
                @else
                    <i id="like-button-{{ $service->id }}" class="cart-button ps-3 text-danger fa-regular fa-heart"
                        onclick="like_clicked({{ $service->id }} @if (!$service->areas->contains($user ? $user->area_id : 0)) ,true @endif)"></i>
                @endif
            </div>
        </div>

        <div class="mt-2 py-2 d-flex justify-content-between align-items-center">
            <div>
                <b>Status: </b>
                <span>
                    {{ $order->order_state->name }}
                </span>
            </div>
            @if ($order->order_member != null)
                <div>
                    <b>Assigned To: </b>
                    <span>
                        {{ $order->order_member->user_organization_membership->user->name }}
                    </span>
                </div>

                <div>
                    <b>Phone Number To: </b>
                    <span>
                        {{ $order->order_member->user_organization_membership->user->phone_number }}
                    </span>
                </div>
            @endif

        </div>

    </div>

</div>
