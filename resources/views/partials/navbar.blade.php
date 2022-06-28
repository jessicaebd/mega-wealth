<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">megAWealth</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('about_us') }}">About Us</a>
                </li>

                @if (Illuminate\Support\Facades\Gate::allows('isAdmin'))

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('manage_office') }}">Manage Offices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('manage_property') }}">Manage Real Estates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                    
                @elseif (Illuminate\Support\Facades\Gate::allows('isMember'))
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('show_cart') }}">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                    
                @else
                
                    <li class="nav-item">
                        <a class="nav-link" href="#">Buy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login_page') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register_page') }}">Register</a>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>
