<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    // public function blocked(Request $request)
    // {
    //     // Ambil Device ID dari session
    //     $deviceId = $request->session()->get('device_id');

    //     // Buat rate limiter key dengan kombinasi IP + User-Agent + Device ID
    //     $key = 'login-attempts:' . $request->ip() . ':' . $request->header('User-Agent') . ':' . $deviceId;

    //     // Ambil waktu pemblokiran dari cache
    //     $blockedUntil = Cache::get("blocked:$key");

    //     // Jika tidak ada data blokir atau waktu sudah habis, arahkan kembali ke login
    //     if (!$blockedUntil || now()->greaterThan($blockedUntil)) {
    //         Cache::forget("blocked:$key"); // Bersihkan cache jika waktu habis
    //         return redirect()->route('login');
    //     }

    //     // Hitung waktu tersisa dalam detik
    //     $remainingTime = now()->diffInSeconds($blockedUntil);

    //     // Kirim data ke view
    //     return view('errors.blocked', compact('remainingTime'));
    // }

    public function notFound()
    {
        return view('errors.404');
        // return response()->view('errors.404', [], 404);
    }

    public function methodNotAllowed()
    {
        return view('errors.405');
    }
}
