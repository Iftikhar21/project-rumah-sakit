<style>
    .navbar {
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
    }

    .nav-link {
        font-weight: 500;
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #667eea !important;
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <a class="navbar-brand text-primary" href="#">
            <i class="bi bi-hospital"></i> RS Sehat Sejahtera
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#igd">IGD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dokter')}}">Dokter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pasien">Pasien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ruangan')}}">Ruangan Rawat Inap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pendaftaran">Pendaftaran</a>
                </li>
            </ul>
            @auth
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img id="profile-preview"
                            src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=15&background=random' }}"
                            class="rounded-circle me-2" style="width: 25px; height: 25px; object-fit: cover;">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <h6 class="dropdown-header">{{ Auth::user()->email }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="">
                                <div class="w-5 h-5">
                                    <img id="profile-preview"
                                        src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=15&background=random' }}"
                                        class="rounded-circle me-2"
                                        style="width: 25px; height: 25px; object-fit: cover;">Profile
                                </div>
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Pengaturan</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('actionLogout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a class="btn btn-login" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>