<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Car Wash</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">Welcome {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary" onclick="location.href='{{ route('dashboard') }}'">Dashboard</button>
                    </li>
                    <span>&nbsp;&nbsp;</span>
                    <li class="nav-item">
                        <button class="btn btn-primary" onclick="location.href='{{ route('profile') }}'">Profile</button>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-primary" onclick="location.href='{{ route('dashboard') }}'">Go to Dashboard</button>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
</header>
