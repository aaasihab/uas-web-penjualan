@extends('layouts.main')

{{-- Styles khusus untuk halaman ini --}}
@section('this-page-style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Formulir Pembayaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('master.data.transaksi.index') }}">Transaksi</a>
                            </li>
                            <li class="breadcrumb-item active">Pembayaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Produk & Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master.data.pembayaran.store', $transaksi->id_transaksi) }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <!-- Nama Produk -->
                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" id="nama_produk" class="form-control"
                                            value="{{ $transaksi->produk->nama }}" readonly>
                                    </div>

                                    <!-- Gambar Produk -->
                                    <div class="form-group text-center">
                                        <img id="gambar_produk" src="{{ asset('storage/' . $transaksi->produk->gambar) }}"
                                            alt="Gambar Produk" class="img-fluid img-thumbnail">
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <!-- Jumlah Produk -->
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah Produk</label>
                                        <input type="number" id="jumlah" class="form-control"
                                            value="{{ $transaksi->jumlah }}" readonly>
                                    </div>

                                    <!-- Total Harga -->
                                    <div class="form-group">
                                        <label for="total_harga">Total Harga</label>
                                        <input type="text" id="total_harga" class="form-control"
                                            value="Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}" readonly>
                                    </div>

                                    <!-- Jumlah Pembayaran -->
                                    <div class="form-group">
                                        <label for="total_pembayaran">Jumlah Pembayaran</label>
                                        <input type="number" id="total_pembayaran" name="total_pembayaran"
                                            class="form-control @error('total_pembayaran') is-invalid @enderror"
                                            value="{{ old('total_pembayaran') }}" required>
                                        @error('total_pembayaran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            Bayar
                                        </button>
                                        <a href="{{ route('master.data.transaksi.index') }}"
                                            class="btn btn-secondary">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- Scripts khusus untuk halaman ini --}}
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
