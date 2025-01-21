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
                        <h1 class="m-0">Tambah Kategori Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('master.data.kategoriProduk.index') }}">Kategori Produk</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
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
                        <h3 class="card-title">Form Tambah Kategori Produk</h3>
                        <div class="card-tools">
                            <a href="{{ route('master.data.kategoriProduk.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master.data.kategoriProduk.store') }}" method="POST">
                            @csrf

                            <!-- Nama Kategori -->
                            <div class="form-group">
                                <label for="nama">Nama Kategori</label>
                                <input type="text" 
                                       class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" 
                                       name="nama" 
                                       value="{{ old('nama') }}" 
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
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                          id="keterangan" 
                                          name="keterangan" 
                                          rows="3" 
                                          placeholder="Masukkan keterangan kategori">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option selected disabled value="">Pilih Status...</option>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('master.data.kategoriProduk.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <span class="text-muted">Isikan data kategori produk dengan benar sebelum disimpan.</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- Untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
@endsection
