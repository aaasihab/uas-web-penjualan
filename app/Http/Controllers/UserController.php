<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        // Validasi data input dengan pesan khusus
        $validated = $request->validate(
            [
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'required|string|in:admin,pelanggan',
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
            ->with('success', 'User berhasil ditambahkan');
    }


    public function edit(string $id)
    {
        // Mengambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Mengirimkan data user ke view 'user.edit'
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|string|in:super_admin,admin,pelanggan',
        ], [
            // Pesan kustom untuk field 'name'
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 50 karakter.',

            // Pesan kustom untuk field 'email'
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',

            // Pesan kustom untuk field 'password'
            // 'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus terdiri dari minimal 6 karakter.',

            // Pesan kustom untuk field 'role'
            'role.required' => 'Role wajib diisi.',
            'role.in' => 'Role yang dipilih tidak valid.',
        ]);

        // Menangani password jika ada perubahan
        if ($request->has('password') && $validated['password'] !== null) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Jika password kosong, kita jangan update field password
            unset($validated['password']);
        }

        // Mencari user yang akan diupdate
        $user = User::findOrFail($id);

        // Perbarui data user
        $user->update($validated);

        // Redirect ke halaman indeks dengan pesan sukses
        return redirect()->route('master.data.user.index')
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari user berdasarkan ID
        $user = User::find($id);

        // Jika user tidak ditemukan
        if (!$user) {
            return redirect()
                ->route('master.data.user.index')
                ->with('error', 'User tidak ditemukan');
        }

        // Hapus data user dari database
        $user->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()
            ->route('master.data.user.index')
            ->with('success', 'User berhasil dihapus');
    }

}
