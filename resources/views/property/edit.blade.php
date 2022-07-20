@extends('layouts.main')

@section('content')
    <div class="container-fluid d-flex justify-container-center pt-5">
        <div class="container " style="width: 800px">
            <form action="{{ route('update_property') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <h1 class="h3 text-center mb-4">Edit Property</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <input type="hidden" name="id" value="{{ $property->id }}">

                <!-- Building Type -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Building Type</span>
                    <select class="form-select" aria-label="Building type selector" name="buildingType" id="buildingType"
                        required>
                        <option value="" selected>Select building type</option>

                        @foreach (App\Models\BuildingType::all() as $bt)
                            <option value="{{ $bt->id }}"
                                {{ old('buildingType') == null
                                    ? ($bt->id == $property->building_type_id
                                        ? 'selected'
                                        : '')
                                    : ($bt->id == old('buildingType')
                                        ? 'selected'
                                        : '') }}>
                                {{ $bt->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Sales Type -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Sales Type</span>
                    <select class="form-select" aria-label="Sales type selector" name="salesType" id="salesType" required>
                        <option value="" selected>Select sales type</option>

                        @foreach (App\Models\SalesType::all() as $st)
                            <option value="{{ $st->id }}"
                                {{ old('salesType') == null
                                    ? ($st->id == $property->sales_type_id
                                        ? 'selected'
                                        : '')
                                    : ($st->id == old('salesType')
                                        ? 'selected'
                                        : '') }}>
                                {{ $st->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Sales Type -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Property Status</span>
                    <select class="form-select" aria-label="Property status selector" name="propertyStatus"
                        id="propertyStatus" required>
                        <option value="{{ $property->property_status_id }}" selected>Select property status</option>

                        @foreach (App\Models\PropertyStatus::all() as $ps)
                            <option value="{{ $ps->id }}"
                                {{ old('salesType') == null
                                    ? ($ps->id == $property->propertyStatus->id
                                        ? 'selected'
                                        : '')
                                    : ($ps->id == old('salesType')
                                        ? 'selected'
                                        : '') }}>
                                {{ $ps->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Price ($)</span>
                    <input type="number" min="1" class="form-control" name="price"
                        placeholder="(per month for rented property)"
                        value="{{ old('price') == null ? $property->price : old('price') }}" required>
                </div>

                <!-- Location -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Location</span>
                    <input type="text" name="location" id="address" class="form-control"
                        placeholder="Recommended format: [address], [country code]"
                        value="{{ old('location') == null ? $property->location : old('location') }}" required />
                </div>

                {{-- Image --}}
                <div class="form-outline mb-4">
                    <label for="image" class="form-label">Upload Image</label>
                    <input class="form-control" type="file" id="image" name="image">
                    <div id="imageHelp" class="form-text">(.jpg, .jpeg, .png)</div>
                </div>

                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ route('manage_property') }}" class="btn btn-secondary me-2">Discard</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
