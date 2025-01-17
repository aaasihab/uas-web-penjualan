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
            /* Ukuran font standar */
        }

        /* Media query untuk ukuran layar lebih kecil dari 768px (mobile) */
        @media (max-width: 768px) {

            table td,
            table th {
                font-size: 0.875rem;
                /* Ukuran font yang lebih kecil pada perangkat mobile */
            }
        }
    </style>
@endsection


@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Pesanan Selesai</h1>
        </div>

        <!-- Tabel Daftar Pembayaran -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>jumlah</th>
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
    </main>
@endsection

@section('this-page-scripts')
    <script>
        // Add any JavaScript or Swall alerts here if needed
    </script>
@endsection
