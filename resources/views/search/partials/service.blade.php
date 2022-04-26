{{-- {{ dd($service -> areas-> contains ($user ? $user->area_id : 0)) }} --}}
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

            <div class="text-end col-lg-6 me-md-5">
                @if ($service->user_service_ratings_stat())
                    @php
                        $stat = $service->user_service_ratings_stat();
                        $rating = $stat->average;
                    @endphp

                    @for ($i = 0; $i < (int) $rating; $i++)
                        <i class="text-warning fa-solid fa-star"></i>
                    @endfor
                    @if ($rating - (int) $rating != 0)
                        <i class="text-warning fa-solid fa-star-half"></i>
                    @endif
                    <span class="mx-1">(
                        <i class="fa-solid fa-user"></i>
                        {{ $stat->count }}
                        )</span>
                @else
                    No Ratings
                @endif

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
        <div class="mt-3 service-location">

            @if ($service->areas->contains($user ? $user->area_id : 0))
                <span class="text-success">
                    <i class="fa-solid fa-location-dot"></i>
                    Available In Your Area -
                </span>
            @else
                <i class="fa-solid fa-location-dot"></i>
            @endif
            @php 
                $count = 0;
            @endphp
            @forelse ($service->areas -> take(10) as $area)
                @php
                    $count ++;
                @endphp
                <span onclick="document.location='{{ route('search', ['areas' => [$area->id]]) }}'"
                    class="area-badge badge @if ($area->id == ($user ? $user->area_id : 0)) bg-success @else bg-dark @endif ">{{ $area->city->name }}
                    - {{ $area->name }}</span>
            @empty
                <span class="badge bg-danger">
                    Not Available in Any Area
                </span>
            @endforelse
            @if ($count >= 10)
                <span class="badge bg-warning">
                    <i>And More..</i>
                </span>
            @endif
        </div>

        <div class="mt-2 py-3 d-flex justify-content-start align-items-center">
            <div class="col-lg-2 d-flex justify-content-start align-items-center">
                @if ($service->areas->contains($user ? $user->area_id : 0))
                    <button class="btn btn-success" onclick="order('{{ route('order.place', ['service' => $service -> id]) }}')">Order</button>
                @else
                    <button class="btn btn-outline-secondary" onclick="order('{{ route('order.place', ['service' => $service -> id]) }}')">Order</button>
                @endif


                @if ($user && $user->services->contains($service->id))
                    <i id="like-button-{{ $service->id }}" class="cart-button ps-3 text-danger fa-solid fa-heart"
                        onclick="like_clicked({{ $service->id }} @if (!$service -> areas-> contains($user ? $user->area_id : 0)) ,true  @endif)"></i>
                @else
                    <i id="like-button-{{ $service->id }}" class="cart-button ps-3 text-danger fa-regular fa-heart"
                        onclick="like_clicked({{ $service->id }} @if (!$service -> areas-> contains ($user ? $user->area_id : 0)) ,true  @endif)"></i>
                @endif
            </div>
        </div>
    </div>

</div>
