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
                        <h1 class="m-0">Pesanan Selesai</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Pesanan Selesai</li>
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
                        <h3 class="card-title">Daftar Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <!-- Tabel Daftar Pembayaran -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Total Pembayaran</th>
                                        <th>Waktu Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->transaksi->produk->nama }}</td>
                                            <td>{{ $item->transaksi->jumlah }}</td>
                                            <td>Rp{{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                                            <td>
                                                {{ $item->waktu_pembayaran ? \Carbon\Carbon::parse($item->waktu_pembayaran)->format('d-m-Y') : 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('this-page-scripts')
@endsection
