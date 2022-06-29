@extends('layouts.main')
{{-- This page is where the user can search the real estate that the user wants. All user can access this page. The user will be able to search by property location, property type, and type of sales. The search results will be displayed in a separate page. The user can also navigate to buy page, rent page, or about us page by clicking the icons below the search bar.
In this page, guest can Login or Register to the page, this page can be accessed by all of the users. Logged in member will have extra button on the navigation bar, which is Cart and Logout. Meanwhile, admin will have extra button which is Manage Company, Manage Real Estate, and Logout. --}}

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="container mt-5">
        <h1>Find Your Future Home</h1>

        {{-- Search property by location, type, type of sales --}}
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('search') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." name="search">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="submit">Go!</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        {{-- End of Search property by location, type, type of sales --}}

        {{-- Buy, Rent, About Us --}}
        <div class="row mt-5">
            <div class="col-md-4 d-flex justify-content-center align-content-center">
                <a href="/property/buy">
                    <img src="/images/login.png" alt="Buy" class="img-fluid" width="150" height="150">
                    <h5 class="text-center p-3">Buy</h5>
                </a>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-content-center">
                <a href="{{ route('rent') }}">
                    <img src="/images/login.png" alt="Rent" class="img-fluid" width="150" height="150">
                    <h5 class="text-center p-3">Rent</h5>
                </a>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-content-center">
                <a href="{{ route('about_us') }}">
                    <img src="/images/login.png" alt="About Us" class="img-fluid" width="150" height="150">
                    <h5 class="text-center p-3">About Us</h5>
                </a>
            </div>
        </div>
        {{-- End of Buy, Rent, About Us --}}
    </div>
@endsection
