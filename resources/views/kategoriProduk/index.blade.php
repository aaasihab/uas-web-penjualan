@extends('layouts.main')

@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Kategori Produk</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tombol Tambah menggunakan tag a -->
                {{-- <a href="" class="btn btn-primary" role="button">Tambah</a> --}}
                <a href="{{ route('master.data.kategoriProduk.create') }}" class="btn btn-primary" role="button">Tambah</a>
            </div>
        </div>
        <div class="container mt-4">
            <!-- Tabel Daftar Kategori Produk -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $kategori)
                        <tr>
                            <td>
                                <!-- Tombol Edit dan Hapus -->
                                <div class="d-flex">
                                    <a href="{{ route('master.data.kategoriProduk.edit', $kategori->id_kategori_produk) }}"
                                        class="btn btn-sm btn-outline-secondary me-1 mb-2">
                                        Edit
                                    </a>
                                    <form id="delete-form-{{ $kategori->id_kategori_produk }}"
                                        action="{{ route('master.data.kategoriProduk.destroy', $kategori->id_kategori_produk) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="confirmDelete({{ $kategori->id_kategori_produk }})">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>{{ $kategori->nama }}</td>
                            <td>{{ $kategori->keterangan ?? 'Tidak ada keterangan' }}</td>
                            <td>
                                @if ($kategori->status === 'aktif')
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
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
    <script>
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
