@extends('layouts.main')

{{-- untuk styles khusus halaman tertentu --}}
@section('this-page-style')
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Buku - Edit</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- tempat button -->
            </div>
        </div>
        <div class="container mt-4">
            <form action="{{ route('master.data.buku.update', $buku->id_buku) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul Buku -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Buku</label>

                    <input type="text" class="form-control  @error('judul') is-invalid @enderror" id="judul"
                        name="judul" value="{{ old('judul', $buku->judul) }}" />
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label @error('kategori_id') is-invalid @enderror">Kategori</label>
                    <select name="kategori_id" class="form-select" id="kategori_id">
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Penulis -->
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis"
                        name="penulis" value="{{ old('penulis', $buku->penulis) }}" />
                    @error('penulis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Penerbit -->
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit"
                        name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" />
                    @error('penerbit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Cover Buku -->
                <div class="mb-3">
                    <label for="cover" class="form-label">Cover Buku</label>
                    <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover"
                        name="cover" accept="image/*" />
                    @if ($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover Buku" class="mt-2"
                            style="width: 150px;">
                    @endif
                    @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="aktif" {{ old('status', $buku->status) == 'aktif' ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="nonaktif" {{ old('status', $buku->status) == 'nonaktif' ? 'selected' : '' }}>
                            Non-Aktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Perbarui</button>
                </div>
            </form>
        </div>
    </main>
@endsection

{{-- untuk scripts khusus halaman tertentu --}}
@section('this-page-scripts')
@endsection
