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
                        <h1 class="m-0">Daftar Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Daftar Transaksi</li>
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
                        <h3 class="card-title">Daftar Riwayat Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <table id="transaction-table" class="table table-striped table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->produk->nama }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($item->status == 'batal')
                                                <span class="badge bg-warning">Dibatalkan</span>
                                            @else
                                                <span class="badge bg-danger">Belum Bayar</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 'belum bayar')
                                                <!-- Tombol Batal -->
                                                <form id="cancel-form-{{ $item->id_transaksi }}"
                                                    action="{{ route('master.data.transaksi.cancel', $item->id_transaksi) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        onclick="confirmCancel({{ $item->id_transaksi }})">
                                                        <i class="fas fa-times"></i> Batal
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfooter>
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
            $("#transaction-table").DataTable({
                "responsive": true,
                "searching": false,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print",]
            }).buttons().container().appendTo('#transaction-table_wrapper .col-md-6:eq(0)');
        });

        function confirmCancel(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Apakah Anda yakin ingin membatalkan pesanan ini secara paksa?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Batalkan!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form untuk memperbarui transaksi
                    document.getElementById(`cancel-form-${id}`).submit();
                }
            });
        }

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
