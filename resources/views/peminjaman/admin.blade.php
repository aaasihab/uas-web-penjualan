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
                            <th>Nama Peminjam</th>
                            <th>Email</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $pinjam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pinjam->user->name }}</td>
                                <td>{{ $pinjam->user->email }}</td>
                                <td>{{ $pinjam->buku->judul }}</td>
                                <td>{{ $pinjam->tanggal_pinjam }}</td>
                                <td>{{ $pinjam->tanggal_kembali }}</td>
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
