@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">User</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Tombol Tambah menggunakan tag a -->
                <a href="{{ route('master.data.user.create') }}" class="btn btn-primary" role="button">Tambah</a>
            </div>
        </div>
        <div class="container mt-4">
            <!-- Tabel Daftar User -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Aksi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('master.data.user.edit', $user->id) }}"
                                    class="btn btn-sm btn-outline-secondary">
                                    Edit
                                </a>
                                <!-- Tombol Hapus -->
                                <form id="delete-user-form-{{ $user->id }}"
                                    action="{{ route('master.data.user.destroy', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="confirmDelete({{ $user->id }})">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->role == 'admin')
                                    <span class="badge bg-success">{{ $user->role }}</span>
                                @else
                                    <span class="badge bg-primary">{{ $user->role }}</span>
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
