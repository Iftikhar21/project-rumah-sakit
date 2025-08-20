@auth
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RS Sehat Sejahtera - Pelayanan Kesehatan Terpercaya</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
            rel="stylesheet">
        <style>
            .hero-section {
                background: #3b3b3b;
                color: white;
                padding: 100px 0;
                position: relative;
                overflow: hidden;
            }

            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><path d="M0,0 C150,100 350,0 500,50 C650,100 850,0 1000,50 L1000,0 Z"></path></svg>') repeat-x;
                background-size: 1000px 100px;
                animation: wave 20s linear infinite;
            }

            @keyframes wave {
                0% {
                    background-position-x: 0;
                }

                100% {
                    background-position-x: 1000px;
                }
            }

            .card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border: none;
                border-radius: 15px;
                overflow: hidden;
            }

            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }

            .service-icon {
                width: 80px;
                height: 80px;
                background: linear-gradient(45deg, #667eea, #764ba2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                color: white;
                font-size: 2rem;
            }

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

            .btn-login {
                background: linear-gradient(45deg, #667eea, #764ba2);
                border: none;
                border-radius: 25px;
                padding: 8px 25px;
                color: white;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn-login:hover {
                transform: scale(1.05);
                box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
                color: white;
            }

            .stats-section {
                background: #f8f9fa;
                padding: 80px 0;
            }

            .stat-number {
                font-size: 3rem;
                font-weight: bold;
                color: #667eea;
                display: block;
            }

            footer {
                background: #2c3e50;
                color: white;
                padding: 40px 0 20px;
            }

            .animate-on-scroll {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s ease;
            }

            .animate-on-scroll.animate {
                opacity: 1;
                transform: translateY(0);
            }
        </style>
    </head>

    <body>
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
                            <a class="nav-link active" href="#home">Home</a>
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
                            <a class="nav-link" href="#ruangan">Ruangan Rawat Inap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pendaftaran">Pendaftaran</a>
                        </li>
                    </ul>
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <h6 class="dropdown-header">{{ Auth::user()->email }}</h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile')}}">
                                        <div class="w-5 h-5">
                                            <img id="profile-preview"
                                                src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=15&background=random' }}"
                                                class="rounded-circle me-2" style="width: 25px; height: 25px; object-fit: cover;">Profile
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

        <!-- Hero Section -->
        <section id="home" class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="animate-on-scroll">
                            <h1 class="display-4 fw-bold mb-4">Pelayanan Kesehatan Terpercaya</h1>
                            <p class="lead mb-4">Memberikan pelayanan kesehatan terbaik dengan teknologi modern dan tenaga
                                medis berpengalaman untuk kesehatan dan kesejahteraan Anda.</p>
                            <div class="d-flex gap-3">
                                <button class="btn btn-light btn-lg px-4 py-2">
                                    <i class="bi bi-calendar-check"></i> Buat Janji
                                </button>
                                <button class="btn btn-outline-light btn-lg px-4 py-2">
                                    <i class="bi bi-telephone"></i> Hubungi Kami
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="animate-on-scroll">
                            <img src="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 300' fill='none'><rect width='400' height='300' fill='rgba(255,255,255,0.1)' rx='20'/><path d='M200 50 L250 100 L200 150 L150 100 Z' fill='white' opacity='0.8'/><circle cx='200' cy='100' r='30' fill='none' stroke='white' stroke-width='3'/><path d='M185 100 L195 110 L215 90' stroke='white' stroke-width='3' fill='none'/></svg>"
                                alt="Healthcare Illustration" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="py-5">
            <div class="container">
                <div class="text-center mb-5 animate-on-scroll">
                    <h2 class="display-5 fw-bold">Layanan Kami</h2>
                    <p class="lead text-muted">Berbagai layanan kesehatan untuk memenuhi kebutuhan Anda</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 animate-on-scroll">
                        <div class="card h-100 text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">IGD 24 Jam</h5>
                                <p class="card-text">Pelayanan gawat darurat 24 jam dengan tim medis siaga dan peralatan
                                    lengkap untuk menangani segala kondisi darurat.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 animate-on-scroll">
                        <div class="card h-100 text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-person-badge"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Dokter Spesialis</h5>
                                <p class="card-text">Tim dokter spesialis berpengalaman dari berbagai bidang untuk
                                    memberikan pelayanan kesehatan terbaik.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 animate-on-scroll">
                        <div class="card h-100 text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Ruang Rawat Inap</h5>
                                <p class="card-text">Fasilitas rawat inap yang nyaman dengan berbagai kelas perawatan sesuai
                                    kebutuhan dan budget Anda.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 animate-on-scroll">
                        <div class="card h-100 text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-clipboard2-pulse"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Medical Check Up</h5>
                                <p class="card-text">Paket pemeriksaan kesehatan lengkap untuk deteksi dini berbagai
                                    penyakit dan menjaga kesehatan optimal.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 animate-on-scroll">
                        <div class="card h-100 text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-capsule"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Farmasi</h5>
                                <p class="card-text">Apotek lengkap dengan berbagai obat-obatan berkualitas dan pelayanan
                                    farmasis yang profesional.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 animate-on-scroll">
                        <div class="card h-100 text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-activity"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Laboratorium</h5>
                                <p class="card-text">Laboratorium dengan teknologi modern untuk pemeriksaan darah, urine,
                                    dan berbagai tes diagnostik lainnya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-3 col-sm-6 mb-4 animate-on-scroll">
                        <span class="stat-number">10+</span>
                        <p class="lead">Tahun Pengalaman</p>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4 animate-on-scroll">
                        <span class="stat-number">50+</span>
                        <p class="lead">Dokter Spesialis</p>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4 animate-on-scroll">
                        <span class="stat-number">1000+</span>
                        <p class="lead">Pasien Terlayani</p>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-4 animate-on-scroll">
                        <span class="stat-number">24/7</span>
                        <p class="lead">Layanan Darurat</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-5 bg-light" id="pendaftaran">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 animate-on-scroll">
                        <h3 class="fw-bold mb-4">Daftar Sekarang</h3>
                        <p class="mb-4">Daftarkan diri Anda untuk mendapatkan pelayanan kesehatan terbaik. Tim kami siap
                            melayani Anda dengan profesional dan ramah.</p>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill text-primary me-3 fs-5"></i>
                                <span>Jl. Kesehatan No. 123, Jakarta Pusat</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-telephone-fill text-primary me-3 fs-5"></i>
                                <span>(021) 123-4567</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope-fill text-primary me-3 fs-5"></i>
                                <span>info@rssehatsejaht era.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 animate-on-scroll">
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-4">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">No. Telepon</label>
                                            <input type="tel" class="form-control" placeholder="Masukkan nomor telepon">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Masukkan email">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Layanan</label>
                                            <select class="form-control">
                                                <option>Pilih layanan</option>
                                                <option>Konsultasi Dokter Umum</option>
                                                <option>Konsultasi Dokter Spesialis</option>
                                                <option>Medical Check Up</option>
                                                <option>IGD</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100 py-3">
                                                <i class="bi bi-send"></i> Daftar Sekarang
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-hospital"></i> RS Sehat Sejahtera
                        </h5>
                        <p>Memberikan pelayanan kesehatan terbaik dengan penuh dedikasi untuk kesehatan dan kesejahteraan
                            masyarakat.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="fw-bold mb-3">Layanan</h6>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-light text-decoration-none">IGD 24 Jam</a></li>
                            <li><a href="#" class="text-light text-decoration-none">Rawat Jalan</a></li>
                            <li><a href="#" class="text-light text-decoration-none">Rawat Inap</a></li>
                            <li><a href="#" class="text-light text-decoration-none">Medical Check Up</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h6 class="fw-bold mb-3">Kontak</h6>
                        <p><i class="bi bi-geo-alt"></i> Jl. Kesehatan No. 123, Jakarta Pusat</p>
                        <p><i class="bi bi-telephone"></i> (021) 123-4567</p>
                        <p><i class="bi bi-envelope"></i> info@rssehatsejaht era.com</p>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p>&copy; 2025 RS Sehat Sejahtera. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                    <div class="modal-header border-0 text-white"
                        style="background: linear-gradient(45deg, #667eea, #764ba2);">
                        <h5 class="modal-title fw-bold" id="loginModalLabel">
                            <i class="bi bi-person-circle me-2"></i>Masuk ke Akun Anda
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Login Form -->
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label fw-semibold">
                                    <i class="bi bi-envelope me-2 text-primary"></i>Email
                                </label>
                                <input type="email" class="form-control form-control-lg" id="loginEmail"
                                    placeholder="Masukkan email Anda" required style="border-radius: 12px;">
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label fw-semibold">
                                    <i class="bi bi-lock me-2 text-primary"></i>Password
                                </label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-control-lg" id="loginPassword"
                                        placeholder="Masukkan password Anda" required
                                        style="border-radius: 12px; padding-right: 45px;">
                                    <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y me-2"
                                        style="border: none; background: none; color: #6c757d;"
                                        onclick="togglePassword('loginPassword')">
                                        <i class="bi bi-eye" id="loginPasswordToggle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Ingat saya
                                </label>
                            </div>
                            <button type="submit" class="btn btn-lg w-100 text-white fw-semibold mb-3"
                                style="background: linear-gradient(45deg, #667eea, #764ba2); border: none; border-radius: 12px; padding: 12px;">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                            </button>
                            <div class="text-center">
                                <a href="#" class="text-decoration-none" style="color: #667eea;">
                                    <i class="bi bi-question-circle me-1"></i>Lupa password?
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-0 bg-light justify-content-center" style="border-radius: 0;">
                        <div class="text-center w-100">
                            <p class="mb-2 text-muted">Belum punya akun?</p>
                            <button type="button" class="btn btn-outline-primary fw-semibold"
                                style="border-radius: 12px; padding: 8px 30px;" onclick="switchToRegister()">
                                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border shadow-lg" style="border-radius: 15px;">
                    <div class="modal-header border-bottom bg-dark text-white">
                        <h5 class="modal-title fw-bold" id="registerModalLabel">
                            <i class="bi bi-person-plus-fill me-2"></i>Pendaftaran Akun Baru
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 bg-light">
                        <!-- Register Form -->
                        <form id="registerForm">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="registerFullName" class="form-label fw-semibold text-dark">
                                        <i class="bi bi-person me-2 text-secondary"></i>Nama Lengkap
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="registerFullName"
                                        placeholder="Masukkan nama lengkap Anda" required
                                        style="border: 2px solid #dee2e6; border-radius: 8px;">
                                </div>
                                <div class="col-12">
                                    <label for="registerEmail" class="form-label fw-semibold text-dark">
                                        <i class="bi bi-envelope me-2 text-secondary"></i>Email
                                    </label>
                                    <input type="email" class="form-control form-control-lg" id="registerEmail"
                                        placeholder="contoh@email.com" required
                                        style="border: 2px solid #dee2e6; border-radius: 8px;">
                                </div>
                                <div class="col-12">
                                    <label for="registerPhone" class="form-label fw-semibold text-dark">
                                        <i class="bi bi-telephone me-2 text-secondary"></i>No. HP
                                    </label>
                                    <input type="tel" class="form-control form-control-lg" id="registerPhone"
                                        placeholder="08xxxxxxxxxx" required
                                        style="border: 2px solid #dee2e6; border-radius: 8px;">
                                </div>
                                <div class="col-12">
                                    <label for="registerAddress" class="form-label fw-semibold text-dark">
                                        <i class="bi bi-geo-alt me-2 text-secondary"></i>Alamat
                                    </label>
                                    <textarea class="form-control" id="registerAddress" rows="3"
                                        placeholder="Masukkan alamat lengkap Anda" required
                                        style="border: 2px solid #dee2e6; border-radius: 8px; resize: none;"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="registerPassword" class="form-label fw-semibold text-dark">
                                        <i class="bi bi-lock me-2 text-secondary"></i>Password
                                    </label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control form-control-lg" id="registerPassword"
                                            placeholder="Minimal 8 karakter" required
                                            style="border: 2px solid #dee2e6; border-radius: 8px; padding-right: 50px;">
                                        <button type="button"
                                            class="btn position-absolute top-50 end-0 translate-middle-y me-2"
                                            style="border: none; background: none; color: #6c757d; z-index: 10;"
                                            onclick="togglePassword('registerPassword')">
                                            <i class="bi bi-eye" id="registerPasswordToggle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="registerConfirmPassword" class="form-label fw-semibold text-dark">
                                        <i class="bi bi-lock-fill me-2 text-secondary"></i>Konfirmasi Password
                                    </label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control form-control-lg"
                                            id="registerConfirmPassword" placeholder="Ulangi password" required
                                            style="border: 2px solid #dee2e6; border-radius: 8px; padding-right: 50px;">
                                        <button type="button"
                                            class="btn position-absolute top-50 end-0 translate-middle-y me-2"
                                            style="border: none; background: none; color: #6c757d; z-index: 10;"
                                            onclick="togglePassword('registerConfirmPassword')">
                                            <i class="bi bi-eye" id="registerConfirmPasswordToggle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                        <label class="form-check-label text-dark" for="agreeTerms">
                                            Saya setuju dengan <a href="#"
                                                class="text-dark fw-semibold text-decoration-underline">Syarat dan
                                                Ketentuan</a>
                                            serta <a href="#"
                                                class="text-dark fw-semibold text-decoration-underline">Kebijakan
                                                Privasi</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-dark btn-lg w-100 fw-semibold"
                                        style="border-radius: 8px; padding: 15px;">
                                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-top bg-white justify-content-center">
                        <div class="text-center w-100">
                            <p class="mb-2 text-muted">Sudah punya akun?</p>
                            <button type="button" class="btn btn-outline-dark fw-semibold"
                                style="border-radius: 8px; padding: 10px 30px;" onclick="switchToLogin()">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Akun
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script>
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                        // Toggle password visibility
                        function togglePassword(fieldId) {
                            const passwordField = document.getElementById(fieldId);
                            const toggleIcon = document.getElementById(fieldId + 'Toggle');

                            if (passwordField.type === 'password') {
                                passwordField.type = 'text';
                                toggleIcon.classList.remove('bi-eye');
                                toggleIcon.classList.add('bi-eye-slash');
                            } else {
                                passwordField.type = 'password';
                                toggleIcon.classList.remove('bi-eye-slash');
                                toggleIcon.classList.add('bi-eye');
                            }
                        }

                        // Switch between login and register modals
                        function switchToRegister() {
                            const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                            const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));

                            loginModal.hide();
                            setTimeout(() => {
                                registerModal.show();
                            }, 300);
                        }

                        function switchToLogin() {
                            const registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
                            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));

                            registerModal.hide();
                            setTimeout(() => {
                                loginModal.show();
                            }, 300);
                        }

                        // Handle login form submission
                        document.getElementById('loginForm').addEventListener('submit', function (e) {
                            e.preventDefault();
                            const email = document.getElementById('loginEmail').value;
                            const password = document.getElementById('loginPassword').value;

                            // Here you would typically send the data to your backend
                            console.log('Login attempt:', { email, password });

                            // Show success message (for demo purposes)
                            alert('Login berhasil! (Demo mode)');

                            // Close modal
                            const loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
                            loginModal.hide();
                        });

                        // Handle register form submission
                        document.getElementById('registerForm').addEventListener('submit', function (e) {
                            e.preventDefault();

                            const password = document.getElementById('registerPassword').value;
                            const confirmPassword = document.getElementById('registerConfirmPassword').value;

                            if (password !== confirmPassword) {
                                alert('Password dan konfirmasi password tidak cocok!');
                                return;
                            }

                            const formData = {
                                firstName: document.getElementById('registerFirstName').value,
                                lastName: document.getElementById('registerLastName').value,
                                email: document.getElementById('registerEmail').value,
                                phone: document.getElementById('registerPhone').value,
                                birthDate: document.getElementById('registerBirthDate').value,
                                password: password
                            };

                            // Here you would typically send the data to your backend
                            console.log('Registration attempt:', formData);

                            // Show success message (for demo purposes)
                            alert('Registrasi berhasil! Silakan login dengan akun baru Anda. (Demo mode)');

                            // Close register modal and open login modal
                            const registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
                            registerModal.hide();
                            setTimeout(() => {
                                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                                loginModal.show();
                            }, 300);
                        });

                        // Form validation styling
                        document.querySelectorAll('input[required]').forEach(input => {
                            input.addEventListener('blur', function () {
                                if (this.value.trim() === '') {
                                    this.classList.add('is-invalid');
                                } else {
                                    this.classList.remove('is-invalid');
                                    this.classList.add('is-valid');
                                }
                            });
                        });
                    }
                });
            });

            // Animate elements on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });

            // Navbar scroll effect
            window.addEventListener('scroll', () => {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 100) {
                    navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
                    navbar.style.backdropFilter = 'blur(10px)';
                } else {
                    navbar.style.backgroundColor = 'white';
                    navbar.style.backdropFilter = 'none';
                }
            });
        </script>
    </body>

    </html>
@endauth