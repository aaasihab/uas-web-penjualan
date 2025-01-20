@extends('layouts.main')

{{-- Untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Tambah Transaksi</li>
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
                        <h3 class="card-title">Detail Produk & Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master.data.transaksi.store', $produks->id_produk) }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <!-- Nama Produk yang Dipilih -->
                                    <div class="form-group">
                                        <label for="nama_produk">Produk yang Dipilih</label>
                                        <input type="text" id="nama_produk" class="form-control"
                                            value="{{ $produks->nama }}" readonly>
                                    </div>

                                    <!-- Gambar Produk yang Dipilih -->
                                    <div class="form-group text-center">
                                        <img id="gambar_produk" src="{{ asset('storage/' . $produks->gambar) }}"
                                            alt="Gambar Produk" class="img-fluid img-thumbnail">
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <!-- Nama Pelanggan -->
                                    <div class="form-group">
                                        <label for="nama_pelanggan">Nama Pelanggan</label>
                                        <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control"
                                            value="{{ auth()->user()->name }}" readonly>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="{{ auth()->user()->email }}" readonly>
                                    </div>

                                    <!-- Stok Produk -->
                                    <div class="form-group">
                                        <label for="stok">Stok Produk</label>
                                        <input type="number" id="stok" class="form-control"
                                            value="{{ $produks->stok }}" readonly>
                                    </div>

                                    <!-- Jumlah -->
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah Yang Akan Dibeli</label>
                                        <input type="number" id="jumlah" name="jumlah"
                                            class="form-control @error('jumlah') is-invalid @enderror"
                                            value="{{ old('jumlah') }}" required min="1" max="{{ $produks->stok }}">
                                        @error('jumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            Masukkan Keranjang
                                        </button>
                                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
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
