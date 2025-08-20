<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Database</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container"><br>
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center"><b>Login Aplikasi</b><br>Dashboard</h3>
                <hr>
                @if(session('error'))
                    <div class="alert alert-danger">
                        <b>Opps!</b> {{ session('error') }}
                        @if(str_contains(session('error'), 'detik'))
                            <div id="countdown" class="mt-2"></div>
                            <script>
                                // Ekstrak waktu dari pesan error
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
                <form action="{{ route('actionlogin') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <p class="text-start mt-5">
                        <a href="{{ route('resetPass') }}">Lupa Password?</a>
                    </p>
                    <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    <hr>
                    <p class="text-center mt-5">
                        <a href="{{ route('register') }}">Belum punya akun? Daftar sekarang!</a>
                    </p>
                </form>
        </div>
    </div>
</body>

</html>