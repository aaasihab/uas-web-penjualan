@extends('layouts.main')

@section('this-page-style')
    <style>
        .card-body {
            min-height: 150px;
            padding: 10px;
        }

        .card-footer {
            height: 40px;
            margin-top: auto;
        }

        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #fff;
            padding: 5px 10px;
            font-weight: bold;
            border-radius: 5px;
        }

        .harga-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ff6f00;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 5px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .favorite-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #ccc;
            cursor: pointer;
        }

        .favorite-icon:hover {
            color: red;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
        }

        .kategori-badge {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 600;
            color: white;
            background-color: #007bff;
            /* Warna sesuai selera */
            border-radius: 20px;
            /* Tinggi tetapi tidak bulat */
        }
    </style>
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>

        <div class="row row-cols-2 row-cols-md-4 g-3">
            @foreach ($produks as $produk)
                <div class="col">
                    <div class="card shadow position-relative h-100">
                        <span class="harga-badge">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top img-fluid" alt="Produk" />
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title fw-bold fs-6">{{ $produk->nama }}</h5>
                            <p class="card-text mt-2">
                                <span class="kategori-badge">{{ $produk->kategoriProduk->nama }}</span>
                            </p>
                            <p class="card-text"><strong>Stok Tersisa:</strong> {{ $produk->stok }}</p>
                        </div>
                        @auth
                            @if (auth()->user()->role === 'pelanggan')
                                <div class="card-footer text-center h-auto">
                                    @if ($produk->status === 'aktif')
                                        <a href="{{ route('master.data.transaksi.create', ['produk' => $produk->id_produk]) }}"
                                            class="btn btn-sm btn-outline-success w-100 fs-6">Beli Produk</a>
                                    @endif
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
                showConfirmButton: false,
                timer: 1000,
            });
        @endif
    </script>
@endsection
