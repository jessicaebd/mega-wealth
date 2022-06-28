@extends('layouts.main')

@section('content')
    <div class="container-fluid d-flex justify-container-center pt-5">
        <div class="container " style="width: 800px">
            <form action="{{ route('store_property') }}" method="post" enctype="multipart/form-data">
                @csrf

                <h1 class="h3 text-center mb-4">Add Real Estate</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Building Type -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Building Type</span>
                    <select class="form-select" aria-label="Building type selector" name="buildingType" id="buildingType"
                        required>
                        <option value="" selected>Select building type</option>

                        @foreach (App\Models\BuildingType::all() as $bt)
                            <option value="{{ $bt->id }}" {{ $bt->id == old('buildingType') ? 'selected' : '' }}> {{ $bt->name }} </option>
                        @endforeach

                    </select>
                </div>

                <!-- Sales Type -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Sales Type</span>
                    <select class="form-select" aria-label="Sales type selector" name="salesType" id="salesType" required>
                        <option value="" selected>Select sales type</option>
                        
                        @foreach (App\Models\SalesType::all() as $st)
                            <option value="{{ $st->id }}" {{ $st->id == old('salesType') ? 'selected' : '' }}> {{ $st->name }} </option>
                        @endforeach

                    </select>
                </div>

                <!-- Price -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Price ($)</span>
                    <input type="number" min="1" class="form-control" name="price" placeholder="(per month for rented property)"
                        value="{{ old('price') }}" required>
                </div>

                <!-- Location -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Location</span>
                    <input type="text" name="location" id="address" class="form-control"
                        placeholder="Recommended format: [address], [country code]" value="{{ old('location') }}"
                        required />
                </div>

                {{-- Image --}}
                <div class="form-outline mb-4">
                    <label for="image" class="form-label">Upload Image</label>
                    <input class="form-control" type="file" id="image" name="image" required>
                    <div id="imageHelp" class="form-text">(.jpg, .jpeg, .png)</div>
                </div>

                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ route('manage_property') }}" class="btn btn-secondary me-2">Discard</a>
                    <button type="submit" class="btn btn-primary">Add Real Estate</button>
                </div>
            </form>
        </div>
    </div>
@endsection
