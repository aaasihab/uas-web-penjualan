@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="content-wrapper">
        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manajemen Pengguna</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Manajemen Pengguna</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pengguna</h3>
                        <div class="card-tools">
                            <!-- Tombol Tambah -->
                            <a href="{{ route('master.data.user.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-user-plus"></i> Tambah
                            </a>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->role == 'admin')
                                                    <span class="badge bg-olive">{{ ucfirst($user->role) }}</span>
                                                @else
                                                    <span class="badge bg-warning">{{ ucfirst($user->role) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('master.data.user.edit', $user->id) }}"
                                                    class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <!-- Tombol Hapus -->
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    onclick="confirmDelete({{ $user->id }})">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                                <form id="delete-user-form-{{ $user->id }}"
                                                    action="{{ route('master.data.user.destroy', $user->id) }}"
                                                    method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "User ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form penghapusan user
                    document.getElementById('delete-user-form-' + userId).submit();
                }
            });
        }
        @if (session('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

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
