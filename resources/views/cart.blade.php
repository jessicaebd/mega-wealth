@extends('layouts.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="container mt-3 pb-4">

        <h4 class="mb-3">Your Cart</h4>

        @if ($cartItems->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-2 mb-4">

                @foreach ($cartItems as $item)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ file_exists(public_path() . "/storage/property/$item->image") ? asset("storage/property/$item->image") : asset('images/default_property.jpg') }}"
                                class="card-img-top" alt="...">

                            <div class="card-body d-flex flex-column justify-content-between">

                                <div>
                                    <h5 class="card-title fw-bold mb-2">
                                        {{ "$" . $item->price . ($item->salesType->name == 'Rent' ? ' / Month' : '') }}
                                    </h5>
                                    <h6 class="card-subtitle fst-italic text-muted">{{ $item->location }}</h6>
                                </div>

                                <div class="mt-3 pb-3">

                                    <div class="badges-container mb-4">
                                        <span class="badge bg-primary text-light">{{ $item->salesType->name }}</span>
                                        <span
                                            class="badge bg-dark text-light">{{ date('d-m-Y', strtotime($item->pivot->add_date)) }}</span>
                                    </div>

                                    <div class="d-flex justify-content-center gap-2">
                                        <form method="post" action="{{ route('discard_cart_item') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-secondary">Discard</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="d-flex">
                <a href="{{ route('checkout_cart_items') }}" class="btn btn-primary mx-auto">Checkout</a>
            </div>
        @else
            <form action="{{ route('search') }}">
                <input type="hidden" name="search" value="">
                <p class="mt-4 text-muted">No data in cart yet. <button type="submit" class="link-primary bg-transparent border-0">Browse Now</button></p>
            </form>
        @endif
    </div>
@endsection
