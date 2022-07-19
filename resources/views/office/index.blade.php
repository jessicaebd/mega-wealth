@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/property/index.css') }}">
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="container">
        <a href="{{ route('add_office') }}" class="btn btn-outline-primary mt-4">+ Add Office</a>

        <div class="container mt-4">
            <div class="row g-2">

                @foreach ($offices as $office)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100">
                            <img src="{{ file_exists(public_path() . "/storage/office/$office->image") ? asset("storage/office/$office->image") : asset('images/default_office.jpg') }}"
                                class="card-img-top" alt="...">

                            <div class="card-body d-flex flex-column justify-content-between">

                                <div>
                                    <h5 class="card-title fw-bold mb-3">{{ $office->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $office->address }}</h6>
                                </div>

                                <div class="mt-3">
                                    <p class="card-text">
                                        {{ $office->contact_name }} <br>
                                        <span style="font-size: 0.9em">{{ $office->phone }}</span>
                                    </p>

                                    <div class="d-flex flex-row justify-content-end mt-4">

                                        <form method="post" action="{{ route('delete_office', $office->id) }}"
                                            class="me-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                        <a href="{{ route('update_office_form', $office->id) }}"
                                            class="btn btn-primary">Update</a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="d-flex flex-row justify-content-center mt-3 pb-3">
                {{ $offices->links() }}
            </div>

        </div>
    @endsection
