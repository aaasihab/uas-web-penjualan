<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view("profile.index");
    }

    public function update(Request $request, $id)
    {
        // Validasi input dengan pesan kustom dalam bahasa Indonesia
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'password_sekarang' => 'nullable|current_password',
            'password_baru' => 'nullable|min:8|confirmed',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password_sekarang.required' => 'Password sekarang wajib diisi jika Anda ingin mengganti password.',
            'password_sekarang.current_password' => 'Password sekarang tidak cocok.',
            'password_baru.min' => 'Password baru minimal 8 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        // Ambil user yang sedang login
        $user = User::find($id);

        // Variabel untuk pesan sukses
        $successMessages = [];

        // Update email jika diperlukan
        if ($request->filled('email') && $request->email != $user->email) {
            $user->email = $request->email;
            $successMessages[] = 'Email berhasil diperbarui';
        }

        // Jika password baru diisi, periksa password sekarang dan update password
        if ($request->filled('password_baru')) {
            if (!$request->filled('password_sekarang')) {
                return back()->withErrors(['password_sekarang' => 'Password sekarang harus diisi jika ingin mengganti password.']);
            }

            // Validasi password sekarang
            if (!Hash::check($request->password_sekarang, $user->password)) {
                return back()->withErrors(['password_sekarang' => 'Password yang Anda masukkan salah.']);
            }

            // Update password baru
            $user->password = Hash::make($request->password_baru);
            $successMessages[] = 'Password berhasil diperbarui';
        }

        // Simpan perubahan
        $user->save(); // Pastikan objek $user adalah instance dari model User

        // Tentukan pesan yang sesuai jika keduanya diperbarui
        if (count($successMessages) == 2) {
            $successMessages = ['Email dan Password berhasil diperbarui'];
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->route('profile.index')->with('success', implode(' ', $successMessages)); // Menampilkan pesan sukses
    }

}
