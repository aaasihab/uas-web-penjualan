@extends('layouts.main')

@section('this-page-style')
    <style>
        .card-body {
            min-height: 100px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-footer {
            height: 40px;
            margin-top: auto;
        }

        .harga-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .card-img-center {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        .card {
            border: 2px solid #3c8dbc;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.01);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
        }

        .produk-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        .kategori-badge {
            display: inline-block;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            background-color: #007bff;
            border-radius: 15px;
        }

        @media (max-width: 767px) {
            .col-lg-3 {
                width: 50%;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .col-lg-3 {
                width: 33.3333%;
            }
        }

        @media (min-width: 992px) {
            .col-lg-3 {
                width: 25%;
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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                @foreach ($produks as $produk)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow position-relative h-100">
                            <span class="harga-badge">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                            <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-center" alt="Produk">
                        </div>
                        <div class="produk-info">
                            <span>{{ $produk->nama }}</span>
                            <span class="kategori-badge">{{ $produk->kategoriProduk->nama }}</span>
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
                @endforeach
            </div>
        </section>
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
