@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
    <style>
        .card-body {
            min-height: 320px;
        }

        .card-footer {
            height: 47px;
            margin-top: auto;
            /* Memastikan tombol berada di bawah */
        }
    </style>
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <!-- Daftar Buku -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($bukus as $buku)
                <div class="col">
                    <div class="card shadow">
                        <!-- Gambar Buku -->
                        <img src="{{ asset('storage/' . $buku->cover) }}" class="card-img-top" height="600"
                            alt="Thumbnail Buku" />
                        <div class="card-body">
                            <!-- Judul Buku -->
                            <h5 class="card-title mb-2">{{ $buku->judul }}</h5>

                            <!-- Deskripsi Buku -->
                            <p class="card-text">{{ $buku->deskripsi }}</p>

                            <!-- Penulis dan Penerbit -->
                            <p class="card-text"><strong>Penulis:</strong> {{ $buku->penulis }}</p>
                            <p class="card-text"><strong>Penerbit:</strong> {{ $buku->penerbit }}</p>
                        </div>

                        <!-- Tombol Pinjam dan Status -->
                        @auth
                            @if (auth()->user()->role === 'pengguna')
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if ($buku->status === 'aktif')
                                            <a href="{{ route('master.data.peminjaman.create', ['buku' => $buku->id_buku]) }}"
                                                class="btn btn-sm btn-outline-secondary px-3">Pinjam</a>
                                            <span class="text-success fw-semibold">Tersedia</span>
                                        @else
                                            <span class="text-danger fw-semibold ms-auto">Tidak Tersedia</span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if ($buku->status === 'aktif')
                                            <span class="text-danger fw-semibold">Belum ada peminjam</span>
                                        @else
                                            @if ($buku->peminjaman && $buku->peminjaman->user)
                                                <span class="text-success fw-semibold">
                                                    Dipinjam oleh {{ $buku->peminjaman->user->name }}
                                                </span>
                                            @else
                                                <span class="text-warning fw-semibold">Buku sedang dinonaktifkan</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
    <script>
        @if (session('login-success'))
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('login-success') }}"
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
            });
        @endif

        @if (session('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK",
            });
        @endif
    </script>
@endsection
