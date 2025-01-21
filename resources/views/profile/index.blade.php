@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pengaturan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Pengaturan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Perbarui Profil Anda</h3>
                        <div class="card-tools">
                            <a href="{{ route('master.data.produk.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Untuk method PUT jika melakukan update -->
                        <div class="card-body">
                            <!-- Email -->
                            <div class="form-group">
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
                            <div class="form-group">
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
                            <div class="form-group">
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
                            <div class="form-group">
                                <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" name="password_baru_confirmation" id="password_baru_confirmation"
                                    class="form-control @error('password_baru_confirmation') is-invalid @enderror">
                                @error('password_baru_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
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
