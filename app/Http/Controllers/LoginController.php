<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            return redirect()->route('login');
        }
        return view('auth/login');
    }

    public function actionlogin(Request $request)
    {
        $maxAttempts = 5;
        $decaySeconds = 34;
        $throttleKey = $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return redirect('/')->with('error', 'Terlalu banyak percobaan login. Coba lagi dalam ' . $seconds . ' detik.');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            RateLimiter::hit($throttleKey, $decaySeconds);

            $error = User::where('email', $request->email)->exists()
                ? 'Password salah'
                : 'Email tidak terdaftar';

            return back()->withInput($request->only('email'))->with('error', $error);
        }

        RateLimiter::clear($throttleKey);

        $user = Auth::user();
        session(['just_logged_in' => true]);
        $request->session()->regenerate();

        // 🔥 Redirect berdasarkan role
        switch ($user->role) {
            case 'user':
                return redirect()->route('pasien-view')
                    ->with('success', 'Selamat datang User !');
            case 'operator':
                return redirect()->route('operator-view')
                    ->with('success', 'Selamat datang Operator !');
            case 'dokter':
                return redirect()->route('dokter-view')
                    ->with('success', 'Selamat datang Dokter, ' . $user->name . '!');
            default:
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Role tidak dikenali, silakan hubungi admin.');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function create(Request $request)
    {
        Session::flash('email', $request->email);

        $request->validate(
            [
                'email' => 'required|email|unique:users|max:255',
                'username' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required'
            ],
            [
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Silahkan masukkan email yang valid (menggunakan @).',
                'email.unique' => 'Email sudah terdaftar.',
                'username.required' => 'Username harus diisi.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'password_confirmation.required' => 'Harap konfirmasi password anda.'
            ]
        );

        $data = [
            'email' => $request->email,
            'name' => $request->username,
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
            if ($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
                unlink(storage_path('app/public/' . $user->photo));
            }

            $path = $request->file('photo')->store('photo_user', 'public');
            $user->photo = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
