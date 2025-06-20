@extends('layouts.main')

@section('this-page-style')
    <style>
        .table th,
        .table td {
            font-size: 1rem;
        }

        @media (max-width: 768px) {

            .table th,
            .table td {
                font-size: 0.875rem;
            }
        }

        .table-container {
            overflow-x: auto;
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
                        <h1 class="m-0">Riwayat Pembayaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Riwayat Pembayaran</li>
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
                        <!-- Tabel Daftar Pembayaran -->
                        <div class="table-responsive table-container">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
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
            </div>
        </section>
    </div>
@endsection


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
