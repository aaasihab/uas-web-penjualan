@extends('layouts.main')

@section('this-page-style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dasbor Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Dasbor Admin</li>
                            <li class="breadcrumb-item"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row d-flex flex-wrap justify-content-center">
                    @php
                        $stats = [
                            [
                                'count' => $jumlahProduk,
                                'label' => 'Produk',
                                'icon' => 'bi-handbag',
                                'color' => 'bg-info',
                                'route' => route('master.data.produk.index'),
                            ],
                            [
                                'count' => $jumlahKategori,
                                'label' => 'Kategori',
                                'icon' => 'bi-tags',
                                'color' => 'bg-success',
                                'route' => route('master.data.kategoriProduk.index'),
                            ],
                            [
                                'count' => $jumlahPengguna,
                                'label' => 'Pendaftaran Pengguna',
                                'icon' => 'bi-person-add',
                                'color' => 'bg-warning',
                                'route' => route('master.data.user.index'),
                            ],
                            [
                                'count' => $jumlahTransaksi,
                                'label' => 'Total Transaksi',
                                'icon' => 'bi-cart-fill',
                                'color' => 'bg-danger',
                                'route' => route('master.data.transaksi.index'),
                            ],
                            [
                                'count' => $totalPenjualan,
                                'label' => 'Total Penjualan',
                                'icon' => 'bi-wallet',
                                'color' => 'bg-purple',
                                'route' => route('master.data.pembayaran.index'),
                            ],
                        ];
                    @endphp

                    @foreach ($stats as $stat)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="small-box {{ $stat['color'] }}">
                                <div class="inner">
                                    <h3>{{ $stat['count'] }}</h3>
                                    <p>{{ $stat['label'] }}</p>
                                </div>
                                <div class="icon mt-4">
                                    <i class="bi {{ $stat['icon'] }}"></i>
                                </div>
                                <a href="{{ $stat['route'] }}" class="small-box-footer">Info Lebih Lanjut <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
@endsection
