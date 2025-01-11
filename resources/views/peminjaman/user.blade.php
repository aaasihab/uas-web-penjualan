@extends('layouts.main')

@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar Peminjaman</h1>
        </div>

        <div class="container mt-4">
            <!-- Tabel Daftar Peminjaman -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $pinjam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pinjam->buku->judul }}</td>
                                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d-m-Y') }}</td>
                                <td>
                                    <form id="update-form-{{ $pinjam->id_peminjaman }}"
                                        action="{{ route('master.data.peminjaman.update', $pinjam->id_peminjaman) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="confirmUpdate({{ $pinjam->id_peminjaman }}, '{{ $pinjam->tanggal_kembali }}')">
                                            Kembalikan
                                        </button>
                                    </form>
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
        function confirmUpdate(id, tglKembali) {
            const formattedDate = new Date(tglKembali).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
            });

            Swal.fire({
                title: "Peminjaman Masih Aktif",
                text: `Peminjaman buku ini masih aktif hingga tanggal ${formattedDate}. Apakah Anda yakin ingin mengembalikan buku ini sekarang?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, kembalikan!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form
                    document.getElementById(`update-form-${id}`).submit();
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
