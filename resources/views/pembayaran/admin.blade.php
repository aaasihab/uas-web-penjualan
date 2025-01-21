@extends('layouts.main')

@section('this-page-style')
    <style>
        .card-body {
            min-height: 320px;
        }

        .card-footer {
            height: 47px;
            margin-top: auto;
        }

        /* Ukuran font default */
        table td,
        table th {
            font-size: 1rem;
        }

        /* Media query untuk ukuran layar lebih kecil dari 768px (mobile) */
        @media (max-width: 768px) {

            table td,
            table th {
                font-size: 0.875rem;
            }
        }
    </style>
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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
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
                        <h3 class="card-title">Daftar Riwayat Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pembayaran-table" class="table table-striped table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga Transaksi</th>
                                        <th>Total Pembayaran</th>
                                        <th>Sisa Kembalian</th>
                                        <th>Waktu Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->transaksi->user->name }}</td>
                                            <td>{{ $item->transaksi->produk->nama }}</td>
                                            <td>{{ $item->transaksi->jumlah }}</td>
                                            <td>{{ $item->transaksi->total_harga }}</td>
                                            <td>Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($item->sisa_kembalian, 0, ',', '.') }}</td>
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
        </section>
    </div>
@endsection

@section('this-page-scripts')
    <script>
        $(function() {
            $("#pembayaran-table").DataTable({
                "responsive": true,
                "searching": false,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", ]
            }).buttons().container().appendTo('#pembayaran-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
