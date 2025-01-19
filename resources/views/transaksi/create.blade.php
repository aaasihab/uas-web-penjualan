@extends('layouts.main')

{{-- Untuk styles khusus halaman tertentu --}}
@section('this-page-style')
    <style>
        .product-image {
            max-width: 125px;
            /* Ukuran gambar yang lebih kecil */
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tambah Transaksi</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tempat button jika diperlukan -->
            </div>
        </div>

        <div class="container mt-4">
            <form action="{{ route('master.data.transaksi.store', $produks->id_produk) }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <!-- Nama Produk yang Dipilih -->
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Produk yang Dipilih</label>
                            <input type="text" id="nama_produk" class="form-control" value="{{ $produks->nama }}"
                                readonly disabled>
                        </div>

                        <!-- Gambar Produk yang Dipilih -->
                        <div class="mb-0">
                            <img id="gambar_produk" src="{{ asset('storage/' . $produks->gambar) }}" alt="Gambar Produk"
                                class="img-fluid product-image">
                        </div>

                        <!-- Stok Produk -->
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok Produk</label>
                            <input type="number" id="stok" class="form-control" value="{{ $produks->stok }}" readonly
                                disabled>
                        </div>

                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Nama Pelanggan -->
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control"
                                value="{{ auth()->user()->name }}" readonly disabled>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ auth()->user()->email }}" readonly disabled>
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Yang Akan Dibeli</label>
                            <input type="number" id="jumlah" name="jumlah"
                                class="form-control  @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}"
                                required min="1" max="{{ $produks->stok }}">
                            @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                Masukkan Keranjang
                            </button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
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

        // Tampilkan SweetAlert untuk pesan error
        @if (session('error'))
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
            });
        @endif
    </script>
@endsection
