<nav class="bg-white shadow-sm navbar navbar-expand-md navbar-light">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-semibold" href="{{ url('/') }}">
            {{ config('title', 'Perfume Shop') }}
        </a>

        <!-- Toggle per mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenuto della navbar -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Link autenticazione -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ url('/admin/perfumes') }}" role="button"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('logout') }}">
                            {{ __('Logout') }}
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style scoped>
    nav {
        background-color: rgb(245, 244, 244);
        color: #ff385c;
        padding: 10px 0;
    }

    a {
        color: black;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .custom_border {
        border-top: 1px solid rgb(182, 177, 177);
    }
</style>
