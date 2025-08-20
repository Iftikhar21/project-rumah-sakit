<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Password;



use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('auth/profile', compact('user'));
    }
    public function login()
    {
        if (Auth::check()) {
            return redirect('login');
        }
        return view('auth/login');
    }

    public function actionlogin(Request $request)
    {
        $maxAttempts = 5;
        $decaySeconds = 34;

        // Gunakan IP address sebagai throttle key utama
        $throttleKey = $request->ip();

        // Cek rate limit berdasarkan IP
        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return redirect('/')->with('error', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $seconds . ' detik.');
        }

        // Validasi form terlebih dahulu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Attempt login
        if (!Auth::attempt($credentials)) {
            // Hit rate limiter pada failed attempt
            RateLimiter::hit($throttleKey, $decaySeconds);

            // Tentukan pesan error yang tepat
            $error = User::where('email', $request->email)->exists()
                ? 'Password salah'
                : 'Email tidak terdaftar';

            return back()->withInput($request->only('email'))->with('error', $error);
        }

        // Login berhasil - clear rate limiter
        RateLimiter::clear($throttleKey);

        // Tambahkan 10 poin setiap login
        $user = Auth::user();
        $user->save();

        // Set session flag untuk menampilkan notifikasi diskon baru
        session(['just_logged_in' => true]);

        // Regenerate session untuk keamanan
        $request->session()->regenerate();

        return redirect()->intended('landingpage')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function create(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        Session::flash('alamat', $request->alamat);
        Session::flash('telepon', $request->telepon);

        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users|max:255',
                'alamat' => 'required|max:500',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'name.required' => 'Nama lengkap harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Silahkan masukkan email yang valid (menggunakan @).',
                'email.unique' => 'Email sudah terdaftar.',
                'alamat.required' => 'Alamat harus diisi.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'password_confirmation.required' => 'Harap konfirmasi password anda.'
            ]
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ];

        User::create($data);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silahkan login');
    }

    public function resetPass()
    {
        return view('auth/reset-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordForm($token)
    {
        return view('auth/form-reset-pass', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.')
            : back()->withErrors(['email' => [__($status)]]);
    }


    public function actionlogout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('login')->with('success', 'Anda telah berhasil logout.');
    }
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Format foto hanya jpg, jpeg, atau png.',
            'photo.max' => 'Ukuran foto maksimal 2MB.'
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
                unlink(storage_path('app/public/' . $user->photo));
            }

            // Simpan foto baru
            $path = $request->file('photo')->store('photo_user', 'public');
            $user->photo = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
