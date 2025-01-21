@extends('layouts.main')

{{-- Styles khusus halaman --}}
@section('this-page-style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('master.data.produk.index') }}">Produk</a></li>
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
                        <h3 class="card-title">Form Tambah Produk</h3>
                        <div class="card-tools">
                            <a href="{{ route('master.data.produk.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master.data.produk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Nama Produk -->
                            <div class="form-group">
                                <label for="nama">Nama Produk</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Masukkan nama produk" />
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"
                                    placeholder="Masukkan deskripsi produk">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Kategori Produk -->
                            <div class="form-group">
                                <label for="kategori_produk_id">Kategori Produk</label>
                                <select name="kategori_produk_id"
                                    class="form-control @error('kategori_produk_id') is-invalid @enderror"
                                    id="kategori_produk_id">
                                    <option value="" disabled selected>Pilih Kategori Produk...</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori_produk }}"
                                            {{ old('kategori_produk_id') == $kategori->id_kategori_produk ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_produk_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Harga -->
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                    id="harga" name="harga" value="{{ old('harga') }}" min="0"
                                    placeholder="Masukkan harga produk" />
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Stok -->
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                    id="stok" name="stok" value="{{ old('stok') }}" min="0"
                                    placeholder="Masukkan stok produk" />
                                @error('stok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Gambar -->
                            <div class="form-group">
                                <label for="gambar">Gambar Produk</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" accept="image/*" />
                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option value="" disabled selected>Pilih Status...</option>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mt-3">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                                <a href="{{ route('master.data.produk.index') }}" class="btn btn-secondary"><i
                                        class="fas fa-times"></i> Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- Scripts khusus halaman --}}
@section('this-page-scripts')
@endsection
