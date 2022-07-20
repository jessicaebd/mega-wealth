@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/property/index.css') }}">
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif

    <div class="container">
        <a href="{{ route('add_property') }}" class="btn btn-outline-primary mt-4">+ Add Real Estate</a>

        <div class="container mt-4">
            <div class="row g-2">

                @foreach ($properties as $property)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <img src="{{ file_exists(public_path() . "/storage/property/$property->image") ? asset("storage/property/$property->image") : asset('images/default_property.jpg') }}"
                                class="card-img-top" alt="...">

                            <div class="card-body d-flex flex-column">

                                <div class="my-2">
                                    <h5 class="card-title fw-bold mb-2">
                                        {{ "$" . $property->price . ($property->salesType->name == 'Rent' ? ' / Month' : '') }}
                                    </h5>
                                    <h6 class="card-subtitle text-muted">{{ $property->location }}</h6>
                                </div>

                                <div class="badges-container mb-auto">
                                    <span class="badge bg-primary text-light">{{ $property->buildingType->name }}</span>
                                    <span class="badge bg-info text-dark">{{ $property->salesType->name }}</span>
                                    <span class="badge bg-dark text-light">{{ $property->propertyStatus->name }}</span>
                                </div>

                                <div class="d-flex flex-row flex-wrap justify-content-end gap-2 action-buttons-wrapper mt-5">

                                    @if ($property->propertyStatus->name != 'Completed')
                                        <form method="post" action="{{ route('delete_property', $property->id) }}"
                                            class="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                        <a href="{{ route('update_property_form', $property->id) }}"
                                            class="btn btn-primary">Update</a>
                                    @endif

                                    @if ($property->propertyStatus->name == 'Completed' && $property->salesType->name == 'Rent')
                                        <form method="post" action="{{ route('up_for_rent') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $property->id }}">
                                            <button type="submit" class="btn btn-dark">Up for Rent</button>
                                        </form>
                                    @endif

                                    @if ($property->propertyStatus->name == 'Added to cart')
                                        <form method="post" action="{{ route('finish_property') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $property->id }}">
                                            <button type="submit" class="btn btn-dark">Finish</button>
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
    </div>
@endsection
