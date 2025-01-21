@extends('layouts.main')

{{-- Untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Produk</li>
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
                        <h3 class="card-title">Daftar Produk</h3>
                        <div class="card-tools">
                            <a href="{{ route('master.data.produk.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-cart-plus"></i> Tambah Produk
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="product-table" class="table table-bordered table-striped mt-3">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $produk->nama }}</td>
                                        <td class="align-middle">{{ $produk->kategoriProduk->nama }}</td>
                                        <td class="align-middle">Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="align-middle">{{ $produk->stok }}</td>
                                        <td class="text-center align-middle">
                                            <!-- Menampilkan gambar -->
                                            @if ($produk->gambar)
                                                <img src="{{ asset('storage/' . $produk->gambar) }}"
                                                    alt="{{ $produk->nama }}" class="img-thumbnail"
                                                    style="width: 75px; height: 75px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <span
                                                class="badge {{ $produk->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($produk->status) }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group">
                                                <a href="{{ route('master.data.produk.edit', $produk->id_produk) }}"
                                                    class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    onclick="confirmDelete({{ $produk->id_produk }})">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                                <form id="delete-form-{{ $produk->id_produk }}"
                                                    action="{{ route('master.data.produk.destroy', $produk->id_produk) }}"
                                                    method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
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

{{-- Untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
    <script>
        $(function() {
            $("#product-table").DataTable({
                "responsive": true,
                "searching": false,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", ]
            }).buttons().container().appendTo('#product-table_wrapper .col-md-6:eq(0)');
        });


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
