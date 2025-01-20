@extends('layouts.main')

@section('this-page-style')
    <style>
        .card {
            border: 2px solid #3c8dbc;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 280px;
            /* Tinggi tetap */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .card-img {
            width: 100%;
            height: auto;
            border-bottom: 3px solid #3c8dbc;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 0 10px;
            flex-grow: 1;
        }

        .product-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            overflow: hidden;
            /* Sembunyikan teks berlebih */
            text-overflow: ellipsis;
            /* Tambahkan elipsis "..." */
            display: -webkit-box;
            /* Untuk membatasi ke beberapa baris */
            -webkit-line-clamp: 2;
            /* Batasi teks ke 2 baris */
            -webkit-box-orient: vertical;
            text-align: center;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-bottom: 3px;
        }

        .product-category {
            font-size: 14px;
            font-style: italic;
            color: #777;
        }

        .cart-icon {
            font-size: 20px;
            color: #3c8dbc;
            cursor: pointer;
        }

        .cart-icon:hover {
            color: #ff6600;
        }

        .price-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ff6600;
            color: white;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .card-wrapper {
            width: 100%;
            max-width: 200px;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 576px) {
            .card-wrapper {
                width: calc(100% / 3 - 20px);
            }
        }

        @media (min-width: 992px) {
            .card-wrapper {
                width: calc(100% / 5 - 20px);
            }
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Selamat Berbelanja {{ Auth::user()->name ?? 'Pelanggan' }}!</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-container pb-4">
            @foreach ($produks as $produk)
                <div class="card-wrapper">
                    <div class="card">
                        <span class="price-badge">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img" alt="Produk">
                        <div class="card-body">
                            <div class="product-name text-center">{{ $produk->nama }}</div>
                            <div class="product-actions">
                                <div class="product-category">{{ $produk->kategoriProduk->nama }}</div>
                                <a href="{{ route('master.data.transaksi.create', ['produk' => $produk->id_produk]) }}">
                                    <i class="bi bi-cart cart-icon"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
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
