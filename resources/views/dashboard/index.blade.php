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
        }
    </style>
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <!-- Daftar Produk -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($produks as $produk)
                <div class="col">
                    <div class="card shadow">
                        <!-- Gambar Produk -->
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top" height="300"
                            alt="Thumbnail Produk" />
                        <div class="card-body">
                            <!-- Nama Produk -->
                            <h5 class="card-title mb-2">{{ $produk->nama }}</h5>

                            <!-- Deskripsi Produk -->
                            <p class="card-text">{{ $produk->deskripsi }}</p>

                            <!-- Harga dan Stok Produk -->
                            <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                            <p class="card-text"><strong>Stok:</strong> {{ $produk->stok }}</p>
                        </div>

                        <!-- Tombol Beli dan Status -->
                        @auth
                            @if (auth()->user()->role === 'pelanggan')
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if ($produk->status === 'aktif')
                                            <a href="{{ route('master.data.transaksi.create', ['produk' => $produk->id_produk]) }}"
                                                class="btn btn-sm btn-outline-secondary px-3">Beli</a>
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
            });
        @endif
    </script>
@endsection
