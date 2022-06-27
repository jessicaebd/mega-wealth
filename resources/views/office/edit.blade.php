@extends('layouts.main')

@section('content')
    <div class="container-fluid d-flex justify-container-center pt-5">
        <div class="container " style="width: 800px">
            <form action="{{ route('update-office') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <h1 class="h3 text-center mb-4">Edit Office</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <input type="hidden" name="id" value="{{ $office->id }}">

                <!-- Office Name -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="name">Office Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') == NULL ? $office->name : old('name') }}"
                        required />
                </div>

                <!-- Office Address -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="address">Office Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') == NULL ? $office->address : old('address') }}"
                        required />
                </div>

                {{-- Contact Name --}}
                <div class="form-outline mb-3">
                    <label class="form-label" for="contactName">Contact Name</label>
                    <input type="text" name="contactName" id="contactName" class="form-control"
                        value="{{ old('contactName') == NULL ? $office->contact_name : old('contactName') }}" required />
                </div>

                {{-- Phone Number --}}
                <div class="form-outline mb-3">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') == NULL ? $office->phone : old('phone') }}"
                        required />
                </div>

                {{-- Image --}}
                <div class="form-outline mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input class="form-control" type="file" id="image" name="image">
                    <div id="emailHelp" class="form-text">(.jpg, .jpeg, .png)</div>
                </div>

                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ route('manage-office') }}" class="btn btn-secondary me-2">Discard</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
