@extends('layouts.main')

{{-- Untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Formulir Peminjaman Buku</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tempat button -->
            </div>
        </div>

        <div class="container mt-4">
            <form action="{{ route('master.data.peminjaman.store', $buku->id_buku) }}" method="POST">
                @csrf

                <!-- Judul Buku  -->
                <div class="mb-3">
                    <label for="judul_buku" class="form-label">Judul Buku</label>
                    <input type="text" id="judul_buku" name="judul_buku" class="form-control" value="{{ $buku->judul }}" readonly>
                </div>

                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                    <input type="text" id="nama_peminjam" name="nama_peminjam" class="form-control" value="{{ auth()->user()->name }}" readonly>
                </div>

                <!-- email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                </div>

                <!-- Tanggal Pinjam -->
                <div class="mb-3">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                        id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}" required>
                    @error('tanggal_pinjam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Tanggal Kembali -->
                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                        id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
                    @error('tanggal_kembali')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        Pinjam Buku
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

{{-- Untuk scripts khusus halaman tertentu --}}
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
