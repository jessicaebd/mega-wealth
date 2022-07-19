<nav class="navbar navbar-expand-lg navbar-light bg-light shadown-sm fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <a class="navbar-brand mt-2 mt-lg-0 " href="{{ route('home') }}">
                <span class="text-pink fw-bold">megAWealth</span>
            </a>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>

                @if (Illuminate\Support\Facades\Gate::allows('isAdmin'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('manage_office') ? 'active' : '' }}"
                            href="{{ route('manage_office') }}">Manage Offices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('manage_property') ? 'active' : '' }}"
                            href="{{ route('manage_property') }}">Manage Real Estates</a>
                    </li>
                @elseif (Illuminate\Support\Facades\Gate::allows('isMember'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about_us') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('about_us') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('buy') ? 'active' : '' }}"
                            href="{{ route('buy') }}">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rent') ? 'active' : '' }}"
                            href="{{ route('rent') }}">Rent</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about_us') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('about_us') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('buy') ? 'active' : '' }}"
                            href="{{ route('buy') }}">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rent') ? 'active' : '' }}"
                            href="{{ route('rent') }}">Rent</a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-flex align-items-center">
            @if (Illuminate\Support\Facades\Gate::allows('isMember'))
                <a class="text-reset me-4 position-relative" href="{{ route('show_cart') }}">
                    <i class="bi bi-cart-fill fs-5"></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ Auth::user()->properties()->count() }}</span>
                </a>

                <a class="text-reset me-4 position-relative" href="{{ route('show_transaction_history') }}">
                    <i class="bi bi-receipt fw-bolder fs-5"></i>
                </a>
            @endif

            @if (Illuminate\Support\Facades\Gate::allows('isAdmin') or Illuminate\Support\Facades\Gate::allows('isMember'))
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="profileDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, {{ Auth::user()->name }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            @else
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary px-3 me-2" href="{{ route('login_page') }}">
                            <span class="text-light">Login</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary px-3" href="{{ route('register_page') }}">
                            Register
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
