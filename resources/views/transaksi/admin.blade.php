@extends('layouts.main')

@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar Riwayat Transaksi</h1>
        </div>

        <div class="container mt-4">
            <!-- Tabel Daftar Transaksi -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Tanggal Transaksi</th>
                            <th>Status</th>
                            <th>Batal</th>
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
                                        <span class="badge bg-warning">Dibatalkan</span> <!-- Menampilkan status -->
                                    @else
                                        <span class="badge bg-danger">Belum Bayar</span> <!-- Menampilkan status -->
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
                                                Batal
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </main>
@endsection

@section('this-page-scripts')
    <script>
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
