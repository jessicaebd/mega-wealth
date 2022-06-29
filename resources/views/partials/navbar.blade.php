<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-flex" id="navbarNav">
            <a class="navbar-brand mt-2 mt-lg-0 " href="/">
                <span class="text-pink fw-bold">megAWealth</span>
            </a>

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('about_us') }}">About Us</a>
                </li>

                @if (Illuminate\Support\Facades\Gate::allows('isAdmin'))
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminManageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Manage
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="adminManageDropdown">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manage_office') }}">Manage Offices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manage_property') }}">Manage Real Estates</a>
                            </li>
                        </ul>
                    </div>
                @elseif (Illuminate\Support\Facades\Gate::allows('isMember'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('buy') }}">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rent') }}">Rent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('show_cart') }}">Cart</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('buy') }}">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rent') }}">Rent</a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-flex align-items-center">
            @if (Illuminate\Support\Facades\Gate::allows('isMember'))
                <a class="text-reset me-3" href="{{ route('show_cart') }}">
                    <i class="bi bi-cart-fill fs-5"></i>
                    <span class="badge rounded-pill badge-notification bg-danger" style="margin-left: -7px;">0</span>
                    {{-- Ceritanya nampilin jumlah cartnya tp blm nemu crnya --}}
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
                            <span class="text-pink">Register</span>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
