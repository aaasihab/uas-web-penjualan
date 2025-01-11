@extends('layouts.main')

@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Daftar Buku</h1>
            <a href="{{ route('master.data.buku.create') }}" class="btn btn-primary mt-2 mt-md-0" role="button">Tambah</a>
        </div>
        <div class="container mt-4">

            <!-- Tabel Daftar Buku -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukus as $buku)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('master.data.buku.edit', $buku->id_buku) }}"
                                            class="btn btn-sm btn-outline-secondary me-1 mb-2">
                                            Edit
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form id="delete-form-{{ $buku->id_buku }}"
                                            action="{{ route('master.data.buku.destroy', $buku->id_buku) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="confirmDelete({{ $buku->id_buku }})">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->kategori->nama }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ $buku->penerbit }}</td>
                                <td>
                                    @if ($buku->status == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Non-Aktif</span>
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
        // Konfirmasi Hapus Data Buku
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form
                    document.getElementById(`delete-form-${id}`).submit();
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