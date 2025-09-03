@extends('template')
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
        <div class="container px-4">
            <div class="row mt-5 mb-5" style="padding-top: 80px;">
                <div class="col-lg-12 margin-tb">
                    <div class="float-left">
                        <h2>CRUD RUANGAN</h2>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('ruangan.create') }}" class="btn btn-success">Input Ruangan</a>
                        <a href="/" class="btn btn-primary">Home</a>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th width="20px" class="text-center">No</th>
                    <th>Kode Ruangan</th>
                    <th width="20%" class="text-center">Nama Ruangan</th>
                    <th width="280px" class="text-center">Kapasitas</th>
                    <th width="280px" class="text-center">Lokasi</th>
                    <th width="20%" class="text-center">Action</th>
                </tr>
                @foreach ($ruangan as $r)
                    <tr>
                        <td class="text-center">{{ ++$i }}</td>
                        <td>{{ $r->kodeRuangan }}</td>
                        <td>{{ $r->namaRuangan }}</td>
                        <td>{{ $r->dayaTampung }}</td>
                        <td>{{ $r->lokasi }}</td>
                        <td class="text-center">
                            <form action="{{ route('ruangan.destroy', $r->id) }}" method="post">
                                <a href="{{ route('ruangan.show', $r->id) }}" class="btn btn-info btn-sm">Show</a>
                                <a href="{{ route('ruangan.edit', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            {!! $ruangan->links() !!}
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endauth