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
                            <a class="nav-link" href="{{ route('landing')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#igd">IGD</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('dokter')}}">Dokter</a>
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
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profil</a></li>
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
        <div class="container px-4">
            <div class="row mt-5 mb-5" style="padding-top: 80px;">
                <div class="col-lg-12 margin-tb">
                    <div class="float-left">
                        <h2>CRUD DOKTER</h2>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('dktr.create') }}" class="btn btn-success">Input Dokter</a>
                        <a href="/" class="btn btn-primary">Home</a>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('succes'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th width="20px" class="text-center">Id</th>
                    <th>ID Dokter</th>
                    <th width="20%" class="text-center">Nama Dokter</th>
                    <th width="280px" class="text-center">Tanggal Lahir</th>
                    <th width="280px" class="text-center">Spesialisasi</th>
                    <th width="20%" class="text-center">Action</th>
                </tr>
                @foreach ($dktr as $dokter)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td>{{ $dokter->idDokter }}</td>
                        <td>{{ $dokter->namaDokter }}</td>
                        <td>{{ $dokter->tanggalLahir }}</td>
                        <td>{{ $dokter->spesialisasi }}</td>
                        <td class="text-center">
                            <form action="{{ route('dktr.destroy', $dokter->id) }}" method="post">
                                <a href="{{ route('dktr.show', $dokter->id) }}" class="btn btn-info btn-sm">Show</a>
                                <a href="{{ route('dktr.edit', $dokter->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $dktr->links() !!}
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