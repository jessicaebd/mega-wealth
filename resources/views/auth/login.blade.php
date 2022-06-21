@extends('layouts.main')

@section('content')
    <div class="container py-4">
        <div class="row d-flex align-items-center">
            <div class="col-6 p-5">
                <img src="images/login.png" alt="" width="80%">
            </div>

            <div class="col-6">
                <div class="shadow rounded-3 p-5">
                    <h3 class="text-center mb-4 fw-bold">Login</h3>

                    <form action="" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email address here...">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Your password must be at least 8 characters.">
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary px-4">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
