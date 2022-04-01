<div class="m-1 my-4 row service-container">
    <div class="service-image-container col-lg-3 d-flex justify-content-center align-items-center">
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

            <div id="ratin-container" class="text-end col-lg-6 me-md-5">
                @php
                    $rating = 3.5;
                @endphp

                @for ($i = 0; $i < (int) $rating; $i++)
                    <i class="text-warning fa-solid fa-star"></i>
                @endfor
                @if ($rating - (int) $rating != 0)
                    <i class="text-warning fa-solid fa-star-half"></i>
                @endif
            </div>
        </div>
        <a class="link-heading">
            <div class="big-text">{{ $service->name }}</div>
        </a>
        <div class="row">
            <span class=" col-lg-3">
                ₹ {{ $service->price }} - {{ $service->price_type->name }}
            </span>
            <span class="col-lg-2">
                <i class="fa-solid fa-tag"></i>
                <a class="link-heading"
                    href="{{ route('search', ['categories_filter' => [$service->service_category->id]]) }}">
                    {{ $service->service_category->name }}
                </a>
            </span>
        </div>
        <div class="mt-3">

            @if ($service->areas->contains($user ? $user->area_id : 0))
                <span class="text-success">
                    <i class="fa-solid fa-location-dot"></i>
                    Available In Your Area -
                </span>
            @else
                <i class="fa-solid fa-location-dot"></i>
            @endif
            @foreach ($service->areas as $area)
                <span onclick="document.location='{{ route('search', ['areas' => [$area->id]]) }}'"
                    class="area-badge badge @if ($area->id == ($user ? $user->area_id : 0)) bg-success @else bg-dark @endif ">{{ $area->city->name }}
                    - {{ $area->name }}</span>
            @endforeach
        </div>

        <div class="mt-2 py-3 d-flex justify-content-start align-items-center">
            <div class="col-lg-2 d-flex justify-content-start align-items-center">
                @if ($service->areas->contains($user ? $user->area_id : 0))
                    <button class="btn btn-success">Order</button>
                @else
                    <button class="btn btn-outline-secondary">Order</button>
                @endif
                <i id="cart-button" class="ps-3 text-danger fa-regular fa-heart"></i>
            </div>
        </div>
    </div>

</div>
