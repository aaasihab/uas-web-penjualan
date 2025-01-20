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
                        <h1 class="m-0">Edit Kategori Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('master.data.kategoriProduk.index') }}">Kategori
                                    Produk</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                        <h3 class="card-title">Form Edit Kategori Produk</h3>
                        <div class="card-tools">
                            <a href="{{ route('master.data.kategoriProduk.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master.data.kategoriProduk.update', $kategori->id_kategori_produk) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nama Kategori -->
                            <div class="form-group">
                                <label for="nama">Nama Kategori</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}"
                                    placeholder="Masukkan nama kategori produk">
                                @error('nama')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Keterangan -->
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                    rows="3" placeholder="Masukkan keterangan kategori">{{ old('keterangan', $kategori->keterangan) }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option value="aktif"
                                        {{ old('status', $kategori->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif"
                                        {{ old('status', $kategori->status) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif
                                    </option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Tombol Perbarui -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Perbarui
                                </button>
                                <a href="{{ route('master.data.kategoriProduk.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times">Batal</i>
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <span class="text-muted">Silakan perbarui data kategori produk sesuai kebutuhan.</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


{{-- Untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
@endsection
