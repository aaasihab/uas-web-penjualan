@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Profil - Update</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        <div class="container mt-4">
            <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Untuk method PUT jika melakukan update -->

                <!-- Email -->
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Sekarang -->
                <div class="mb-3">
                    <label for="password_sekarang">Password Sekarang</label>
                    <input type="password" name="password_sekarang" id="password_sekarang"
                        class="form-control @error('password_sekarang') is-invalid @enderror">
                    @error('password_sekarang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password Baru -->
                <div class="mb-3">
                    <label for="password_baru">Password Baru</label>
                    <input type="password" name="password_baru" id="password_baru"
                        class="form-control @error('password_baru') is-invalid @enderror">
                    @error('password_baru')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Konfirmasi Password Baru -->
                <div class="mb-3">
                    <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="password_baru_confirmation" id="password_baru_confirmation"
                        class="form-control @error('password_baru_confirmation') is-invalid @enderror">
                    @error('password_baru_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
    <script>
        // Tampilkan SweetAlert untuk pesan sukses
        @if (session('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endsection
