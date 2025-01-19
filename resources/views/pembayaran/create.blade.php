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
            <h1 class="h2">Formulir Pembayaran</h1>
        </div>

        <div class="container mt-4">
            <form action="{{ route('master.data.pembayaran.store', $transaksi->id_transaksi) }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <!-- Nama Produk yang Dipilih -->
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" id="nama_produk" class="form-control"
                                value="{{ $transaksi->produk->nama }}" readonly disabled>
                        </div>

                        <!-- Gambar Produk yang Dipilih -->
                        <div class="mb-0">
                            <img id="gambar_produk" src="{{ asset('storage/' . $transaksi->produk->gambar) }}"
                                alt="Gambar Produk" class="img-fluid product-image" readonly disabled>
                        </div>

                        <!-- Harga Produk -->
                        <div class="mb-3">
                            <label for="harga_produk" class="form-label">Harga Produk</label>
                            <input type="text" id="harga_produk" class="form-control"
                                value="Rp{{ number_format($transaksi->produk->harga, 0, ',', '.') }}" readonly disabled>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Jumlah Produk -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Produk</label>
                            <input type="number" id="jumlah" class="form-control"
                                value="{{ $transaksi->jumlah }}" readonly disabled>
                        </div>

                        <!-- Total Harga -->
                        <div class="mb-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="text" id="total_harga" class="form-control"
                                value="Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}" readonly disabled>
                        </div>

                        <!-- Jumlah Pembayaran -->
                        <div class="mb-3">
                            <label for="total_pembayaran" class="form-label">Jumlah Pembayaran</label>
                            <input type="number" id="total_pembayaran" name="total_pembayaran"
                                class="form-control @error('total_pembayaran') is-invalid @enderror"
                                value="{{ old('total_pembayaran') }}" required>
                            @error('total_pembayaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Bayar
                        </button>
                        <a href="{{ route('master.data.transaksi.index') }}" class="btn btn-secondary">Batal</a>

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
