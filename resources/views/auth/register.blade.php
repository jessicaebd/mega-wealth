@extends('layouts.main')

@section('content')
    <div class="container py-4">
        <div class="row d-flex align-items-center">
            <div class="col-6 p-5">
                <img src="images/register.png" alt="" width="80%">
            </div>

            <div class="col-6">
                <div class="shadow rounded-3 p-5">
                    <h3 class="text-center mb-4 fw-bold">Register</h3>

                    <form action="" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your name here...">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email address here...">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Your password must be at least 8 characters.">
                        </div>

                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="Re-type your password.">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary px-4">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
