<nav class="navbar navbar-expand-lg navbar-dark bg-transparent px-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/dashboard') }}?username={{ urlencode($username) }}">Magical Library</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboard') }}?username={{ urlencode($username) }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/pengelolaan') }}?username={{ urlencode($username) }}">Pengelolaan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/profile') }}?username={{ urlencode($username) }}">Profile</a>
                </li>
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-magical btn-sm ms-3">
                            mahou shoten no tobira o shimeru
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
