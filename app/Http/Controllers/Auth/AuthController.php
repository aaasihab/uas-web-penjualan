<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Str;
use Validator;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data input dengan pesan khusus
        $validated = $request->validate(
            [
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'required|string|pelanggan',
            ],
            [
                // Pesan kustom untuk validasi
                'name.required' => 'Nama wajib diisi.',
                'name.string' => 'Nama harus berupa teks.',
                'name.max' => 'Nama tidak boleh lebih dari 50 karakter.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
                'email.unique' => 'Email sudah terdaftar.',

                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password harus terdiri dari minimal 6 karakter.',

                'role.required' => 'Role wajib dipilih.',
                'role.in' => 'Role yang dipilih tidak valid.',
            ]
        );

        // Enkripsi password
        $validated['password'] = Hash::make($validated['password']);

        // Menambahkan user baru ke database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
            ->route('master.data.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    //  Menampilkan halaman register
    public function registerForm()
    {
        return view('auth.registerForm'); // Pastikan file `registerForm.blade.php` tersedia
    }

    public function register(Request $request)
    {
        // Validasi input dengan pesan khusus
        $validated = $request->validate(
            [
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'name.required' => 'Nama wajib diisi.',
                'name.string' => 'Nama harus berupa teks.',
                'name.max' => 'Nama tidak boleh lebih dari 50 karakter.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
                'email.unique' => 'Email sudah terdaftar.',

                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
            ]
        );

        // Enkripsi password
        $validated['password'] = Hash::make($validated['password']);

        // Tambahkan pengguna baru ke database dengan role otomatis 'pengguna'
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'pelanggan', // Role diatur otomatis di backend
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil');
    }


    public function loginForm()
    {
        return view('auth.loginForm');
    }

    // Menangani proses login.
    public function login(Request $request)
    {
        // Dapatkan Device ID dari session (jika tidak ada, buat baru)
        if (!$request->session()->has('device_id')) {
            $request->session()->put('device_id', Str::uuid()->toString());
        }
        $deviceId = $request->session()->get('device_id');

        // Buat rate limiter key dengan kombinasi IP + User-Agent + Device ID
        $key = 'login-attempts:' . $request->ip() . ':' . $request->header('User-Agent') . ':' . $deviceId;

        // Jika sudah melebihi batas percobaan login
        if (RateLimiter::tooManyAttempts($key, 2)) {
            $blockedUntil = now()->addSeconds(RateLimiter::availableIn($key)); // Hitung kapan blokir berakhir
            session(['blocked_until' => $blockedUntil]); // Simpan di session

            return redirect()->route('blocked');
        }


        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email|max:30',
            'password' => 'required|min:8|max:30',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email tidak boleh lebih dari 30 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter',
            'password.max' => 'Password tidak boleh lebih dari 30 karakter',
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            RateLimiter::hit($key, 120); // Tambahkan hitungan rate limiter, reset dalam 60 detik
            $attemptsLeft = RateLimiter::remaining($key, 2); // Hitung percobaan tersisa

            return back()->with('error', "Email atau password salah. Percobaan tersisa: $attemptsLeft.");
        }

        // Jika berhasil login, reset rate limiter
        Auth::attempt($request->only(['email', 'password']));
        $request->session()->regenerate();
        RateLimiter::clear($key); // Hapus hitungan percobaan

        return redirect()->intended('/')->with('login-success', 'Login berhasil.');
    }




    public function logout(Request $request)
    {
        // Logout, invalidasi session, dan regenerasi token
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login');
    }

    // Menampilkan halaman unauthorized
    public function unauthorized()
    {
        return view('auth.403');
    }
}
