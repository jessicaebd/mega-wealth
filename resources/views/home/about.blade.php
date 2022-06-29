@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5" id="about-wrap">
        <div class="pt-3 pb-2" id="about-content">
            <h1 class="text-center mb-5">About Our Company</h1>
            <p class="text-center">Our company was founded at 2008 by our founder Renanda. At that time, we started as law firm specializing in
                real estate and construction. In 2012, our company expanded our service to real estates with the included
                service of real estates lawyers. Today, our company have {{ App\Models\Office::count() }} offices
                throughout the states and is planning to build more.</p>
        </div>
    </div>

    <div class="container mt-5 pb-4">
        <h4 class="mb-3 fw-bold">Our Offices</h4>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-2 mb-4">

            @foreach ($offices as $office)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ file_exists(public_path() . "/storage/office/$office->image") ? asset("storage/office/$office->image") : asset('images/default_office.jpg') }}"
                            class="card-img-top" alt="...">

                        <div class="card-body d-flex flex-column justify-content-between">

                            <div>
                                <h5 class="card-title fw-bold mb-2">{{ $office->name }}</h5>
                                <h6 class="card-subtitle fst-italic mb-2 text-muted">{{ $office->address }}</h6>
                            </div>

                            <div class="mt-3">
                                <p class="card-text">
                                    {{ $office->contact_name }} <br>
                                    <span style="font-size: 0.9em">{{ $office->phone }}</span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="d-flex flex-row justify-content-center mt-3">
            {{ $offices->links() }}
        </div>

    </div>
@endsection
