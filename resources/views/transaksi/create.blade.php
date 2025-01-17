@extends('layouts.main')

{{-- Untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Form Tambah Transaksi</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tempat button jika diperlukan -->
            </div>
        </div>

        <div class="container mt-4">
            <form action="{{ route('master.data.transaksi.store', $produks->id_produk) }}" method="POST">
                @csrf

                <!-- Nama Pelanggan -->
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control"
                        value="{{ auth()->user()->name }}" readonly>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ auth()->user()->email }}" readonly>
                </div>

                <!-- Nama Produk yang Dipilih -->
                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Produk yang Dipilih</label>
                    <input type="text" id="nama_produk" class="form-control" value="{{ $produks->nama }}" readonly>
                </div>

                <!-- Gambar Produk yang Dipilih -->
                <div class="mb-3">
                    <label for="gambar_produk" class="form-label">Gambar Produk</label>
                    <img id="gambar_produk" src="{{ asset('storage/' . $produks->gambar) }}" alt="Gambar Produk" class="img-fluid" style="max-width: 200px;" readonly>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah"
                        class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" required>
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

        // JavaScript untuk memperbarui nama dan gambar produk yang dipilih
        document.getElementById('produk_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var namaProduk = selectedOption.getAttribute('data-nama');
            var gambarProduk = selectedOption.getAttribute('data-gambar');

            // Update input untuk nama produk dan gambar produk
            document.getElementById('nama_produk').value = namaProduk;
            document.getElementById('gambar_produk').src = gambarProduk;
        });
    </script>
@endsection
