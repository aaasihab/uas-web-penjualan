<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function blocked()
    {
        $blockedUntil = session('blocked_until');

        // Jika tidak ada session blokir atau waktu sudah habis, arahkan kembali ke login
        if (!$blockedUntil || now()->greaterThan($blockedUntil)) {
            return redirect()->route('login');
        }

        $remainingTime = now()->diffInSeconds($blockedUntil);

        return view('errors.blocked', compact('remainingTime'));
    }
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
