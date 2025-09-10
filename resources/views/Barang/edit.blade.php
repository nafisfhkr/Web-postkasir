@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Barang</h1>

    <!-- Tampilkan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Barang -->
    <form action="{{ route('barang.update', $barang->BarangID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="Nama_barang" name="Nama_barang" value="{{ old('Nama_barang', $barang->Nama_barang) }}" required>
        </div>

        <div class="mb-3">
    <label for="kategoriID" class="form-label">Kategori</label>
    <select name="kategoriID" id="kategoriID" class="form-select" required>
        <option value="">Pilih Kategori</option>
        @foreach ($kategories as $kategori)
            <option value="{{ $kategori->KategoriID }}" 
                {{ old('kategoriID', $barang->kategoriID) == $kategori->KategoriID ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('kategoriID'))
        <div class="text-danger">
            {{ $errors->first('kategoriID') }}
        </div>
    @endif
</div>


        <div class="mb-3">
            <label for="Harga_jual" class="form-label">Harga Jual</label>
            <input type="number" class="form-control" id="Harga_jual" name="Harga_jual" value="{{ old('Harga_jual', $barang->Harga_jual) }}" required>
        </div>

        <div class="mb-3">
            <label for="Harga_dasar" class="form-label">Harga Dasar</label>
            <input type="number" class="form-control" id="Harga_dasar" name="Harga_dasar" value="{{ old('Harga_dasar', $barang->Harga_dasar) }}" required>
        </div>

        <div class="mb-3">
            <label for="Stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="Stok" name="Stok" value="{{ old('Stok', $barang->Stok) }}" required>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Kode Barang</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $barang->code) }}">
        </div>

        <div class="mb-3">
            <label for="show_in_transaction" class="form-label">Tampilkan di Transaksi</label>
            <select name="show_in_transaction" id="show_in_transaction" class="form-select">
                <option value="1" {{ $barang->show_in_transaction ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ !$barang->show_in_transaction ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="use_stock" class="form-label">Gunakan Stok</label>
            <select name="use_stock" id="use_stock" class="form-select">
                <option value="1" {{ $barang->use_stock ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ !$barang->use_stock ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Barang</label>
            @if ($barang->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $barang->foto) }}" style="width: 100px; height: 100px; object-fit: cover;" alt="Foto Barang">
                </div>
            @endif
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
