<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Database</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container"><br>
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center"><b>Register Aplikasi</b><br>Dashboard</h3>
                <hr>
                <!-- Tampilkan error validasi -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <b>Opps!</b> {{ session('error') }}
                        @if(str_contains(session('error'), 'detik'))
                            <div id="countdown" class="mt-2"></div>
                            <script>
                                const msg = "{{ session('error') }}";
                                const time = parseInt(msg.match(/\d+/)[0]);

                                let seconds = time;
                                const countdown = setInterval(() => {
                                    document.getElementById('countdown').innerHTML =
                                        `Tersisa: ${seconds} detik`;
                                    seconds--;

                                    if (seconds < 0) {
                                        clearInterval(countdown);
                                        location.reload();
                                    }
                                }, 1000);
                            </script>
                        @endif
                    </div>
                @endif

                <form action="{{ route('create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="username" name="username" class="form-control @error('username') is-invalid @enderror"
                            placeholder="Username" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password (minimal 8 karakter)</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Ulangi Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                    <hr>
                    <p class="text-center mt-5">
                        <a href="{{ route('login') }}">Sudah punya akun? Login sekarang!</a>
                    </p>
                </form>
        </div>
    </div>
</body>

</html>