@extends('template-operator')

@section('content')
    <div class="container-fluid px-4 py-1">
        {{-- Header Section --}}
        <div class="row mb-4" style="margin-top: 60px;">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 text-dark mb-1">Dashboard</h1>
                            <p class="text-muted mb-0">Selamat datang <span
                                    class="fw-bold">{{ $operator->nama_operator ?? Auth::user()->name ?? '-' }}</span> !</p>
                        </div>
                        <div class="text-end">
                            <small class="text-muted">{{ date('l, d F Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Alert Success --}}
        @if ($message = Session::get('success'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row g-4">
            {{-- Profile Card --}}
            <div class="col-md-12">
                <div class="card shadow-sm h-100 w-100">
                    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
                        <div class="icon-shape bg-primary bg-gradient rounded-3 me-3 d-flex align-items-center justify-content-center"
                            style="width: 45px; height: 45px;">
                            <img id="profile-preview"
                                src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=15&background=random' }}"
                                class="rounded-circle" style="width: 25px; height: 25px; object-fit: cover;">
                        </div>
                        <div>
                            <h5 class="mb-0">Informasi Profil</h5>
                            <small class="text-muted">Data pribadi Operator</small>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">ID Operator</label>
                                <p class="fw-semibold mb-0">{{ $operator->kode_operator ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">Nama Operator</label>
                                <p class="fw-semibold mb-0">{{ $operator->nama_operator ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .icon-shape {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-item {
            padding: 12px 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .card {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .alert {
            border-radius: 12px;
        }

        .badge {
            font-size: 0.75rem;
            padding: 6px 12px;
        }
    </style>

@endsection