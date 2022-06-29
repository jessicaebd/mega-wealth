@extends('layouts.main')

@section('content')
    <div class="container mt-5">

        @if ($message)
            <div class="alert alert-danger">
                {{ $message }}
            </div>

            <h5 class="fw-bold">Showing All Result</h5>
        @else
            <h5 class="fw-bold">Showing Search Result for '{{ $search }}'</h5>
        @endif

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
                                    <span class="badge bg-primary text-light">{{ $property->buildingType->name }}</span>
                                    <span class="badge bg-info text-dark">{{ $property->salesType->name }}</span>
                                    <span class="badge bg-dark text-light">{{ $property->propertyStatus->name }}</span>
                                </div>

                                {{-- ! Middleware Blom: If the user has already logged in as a member, by clicking the buy or rent button, the user will be able to add the selected real estate to their cart. If the user has not logged in, the user will be redirected to the Login Page. --}}
                                <div class="d-flex flex-row flex-wrap justify-content-center gap-2 action-buttons-wrapper">
                                    <a href="" class="btn btn-primary">{{ $property->salesType->name }}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- ! Paginate masih error --}}
        <div class="d-flex flex-row justify-content-center mt-3 pb-3">
            {{ $properties->links() }}
        </div>

    </div>
@endsection
