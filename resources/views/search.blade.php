@extends('layouts.main')

@section('content')

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="container mt-5">

        <h5 class="fw-bold">Showing Search Result for '{{ $search }}'</h5>

        @if ($properties->count() == 0)
            <div class="alert alert-danger">No data found</div>
        @else
            <div class="row g-2">
                @foreach ($properties as $property)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <img src="{{ file_exists(public_path() . "/storage/property/$property->image") ? asset("storage/property/$property->image") : asset('images/default_property.jpg') }}"
                                class="card-img-top" alt="...">

                            <div class="card-body d-flex flex-column justify-content-between">

                                <div class="my-2">
                                    <h5 class="card-title fw-bold mb-2">
                                        {{ "$" . $property->price . ($property->salesType->name == 'Rent' ? ' / Month' : '') }}
                                    </h5>
                                    <h6 class="card-subtitle text-muted">{{ $property->location }}</h6>
                                </div>

                                <div class="pb-3">
                                    <div class="badges-container mb-5">
                                        <span
                                            class="badge bg-primary text-light">{{ $property->buildingType->name }}</span>
                                        <span class="badge bg-info text-dark">{{ $property->salesType->name }}</span>
                                        {{-- ini ga perlu, user ga perlu tau --}}
                                        <span
                                            class="badge bg-dark text-light">{{ $property->propertyStatus->name }}</span>
                                    </div>

                                    <div class="d-flex flex-row justify-content-center gap-2">
                                        @if (Auth::user() && Auth::user()->properties()->where('id', $property->id)->exists())
                                            <form method="post" action="{{ route('discard_cart_item') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $property->id }}">
                                                <button type="submit" class="btn btn-outline-danger">Remove from
                                                    Cart</button>
                                            </form>
                                        @else
                                            <?php Session::put('url.intended', URL::full()); ?>
                                            <form method="post" action="{{ route('insert_cart_item') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $property->id }}">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ $property->salesType->name }}</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif

        {{-- ! Paginate masih error --}}
        <div class="d-flex flex-row justify-content-center mt-3 pb-3">
            {{ $properties->links() }}
        </div>

    </div>
@endsection
