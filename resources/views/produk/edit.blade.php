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
                        <h1 class="m-0">Edit Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('master.data.produk.index') }}">Produk</a></li>
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
                        <h3 class="card-title">Form Edit Produk</h3>
                        <a href="{{ route('master.data.produk.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master.data.produk.update', $produk->id_produk) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nama Produk -->
                            <div class="form-group">
                                <label for="nama">Nama Produk</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $produk->nama) }}"
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
                                    placeholder="Masukkan deskripsi produk">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
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
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori_produk }}"
                                            {{ old('kategori_produk_id', $produk->kategori_produk_id) == $kategori->id_kategori_produk ? 'selected' : '' }}>
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
                                    id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" min="0"
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
                                    id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" min="0"
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
                                @if ($produk->gambar)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk"
                                            class="img-thumbnail" style="width: 150px;">
                                    </div>
                                @endif
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
                                    <option value="aktif"
                                        {{ old('status', $produk->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif"
                                        {{ old('status', $produk->status) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif
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
                                <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Perbarui</button>
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

{{-- Untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
@endsection
