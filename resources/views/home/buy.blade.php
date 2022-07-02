@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/property/index.css') }}">
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="container mt-4">
        <h5 class="fw-bold mb-4">Showing Search Result for Sale</h5>

        <div class="row g-2">
            @foreach ($properties as $property)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ file_exists(public_path() . "/storage/property/$property->image") ? asset("storage/property/$property->image") : asset('images/default_property.jpg') }}"
                            class="card-img-top" alt="...">

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="my-2">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title fw-bold mb-2">
                                        {{ "$" . $property->price }}
                                    </h5>
                                    <p class="badge bg-dark text-light">{{ $property->buildingType->name }}</p>
                                </div>
                                <h6 class="card-subtitle text-muted">{{ $property->location }}</h6>
                            </div>

                            {{-- ! Kl dah bener ini di buang --}}
                            <div class="badges-container mb-5">
                                <span class="badge bg-primary text-light">{{ $property->buildingType->name }}</span>
                                <span class="badge bg-info text-dark">{{ $property->salesType->name }}</span>
                                {{-- yang ini ga perlu --}}
                                <span class="badge bg-dark text-light">{{ $property->propertyStatus->name }}</span>
                            </div>
                            {{-- ! Kl dah bener ini di buang --}}

                            <div class="d-flex flex-row flex-wrap justify-content-center gap-2 action-buttons-wrapper">
                                @if (Auth::user() &&
                                    Auth::user()->properties()->where('id', $property->id)->exists())
                                    <form method="post" action="{{ route('discard_cart_item') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $property->id }}">
                                        <button type="submit" class="btn btn-outline-danger px-4">Remove from
                                            Cart</button>
                                    </form>
                                @else
                                    <?php Session::put('url.intended', URL::full()); ?>
                                    <form method="post" action="{{ route('insert_cart_item') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $property->id }}">
                                        <button type="submit"
                                            class="btn btn-primary px-4">{{ $property->salesType->name }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex flex-row justify-content-center mt-3 pb-3">
            {{ $properties->links() }}
        </div>
    </div>
@endsection
