@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h3 class="fw-bold mb-5 text-center">Transaction History</h3>

        @if ($transactions->count() > 0)
            <div class="row d-flex justify-content-center">
                @foreach ($transactions as $transaction)
                    <div class="col-md-10">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ file_exists(public_path() . '/storage/property/' . $transaction->image) ? asset('storage/property/' . $transaction->image) : asset('images/default_property.jpg') }}"
                                        class="card-img-top" alt="...">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <small class="fw-bolder text-pink">Transaction ID:
                                            #{{ Str::limit($transaction->id, 7, '') }}</small>
                                        <h5 class="card-title">{{ $transaction->location }}</h5>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <p class="badge bg-pink text-light me-2">
                                                    {{ $transaction->salesType->name }}
                                                </p>
                                                <p class="badge bg-dark text-light">{{ $transaction->buildingType->name }}
                                                </p>
                                            </div>
                                            <h5 class="card-title fw-bold mb-2">
                                                {{ "$" . $transaction->price }}
                                            </h5>
                                        </div>
                                        <p class="card-text"><small
                                                class="text-muted">{{ $transaction->transaction_date }}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h1>Kosong</h1>
        @endif
    </div>
@endsection
