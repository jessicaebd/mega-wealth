@extends('layouts.main')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="header px-4 py-4 mb-5 text-center d-flex flex-column justify-content-center align-content-center">
        <h1 class="display-5 fw-bold text-pink">Find Your Future Home</h1>

        {{-- Search property by location, type, type of sales --}}
        <div class="col-md-10 mx-auto">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ Illuminate\Support\Facades\Gate::allows('isAdmin') ? route('manage_property') : route('search') }}">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                placeholder="Enter a City, Property Type, Buy or Rent..." name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-lg px-4 gap-3" type="submit">Go!</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End of Search property by location, type, type of sales --}}
    </div>

    {{-- Buy, Rent, About Us --}}
    <div class="container mt-4">
        <div class="row my-5">
            <div class="col-md-4 d-flex justify-content-center align-content-center grow">
                <a href="{{ route('buy') }}">
                    <img src="/images/buy.png" alt="Buy" class="img-fluid mb-1" width="250" height="250">
                    <h5 class="text-center fw-bold">Buy</h5>
                </a>
            </div>

            <div class="col-md-4 d-flex justify-content-center align-content-center grow">
                <a href="{{ route('rent') }}">
                    <img src="/images/rent.png" alt="Rent" class="img-fluid mb-1" width="250" height="250">
                    <h5 class="text-center fw-bold">Rent</h5>
                </a>
            </div>

            <div class="col-md-4 d-flex justify-content-center align-content-center grow">
                <a href="{{ route('about_us') }}">
                    <img src="/images/about.png" alt="About Us" class="img-fluid mb-1" width="250" height="250">
                    <h5 class="text-center fw-bold">About Us</h5>
                </a>
            </div>
        </div>
    </div>
    {{-- End of Buy, Rent, About Us --}}
@endsection
