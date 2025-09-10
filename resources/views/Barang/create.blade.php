@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Barang</h1>
    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="Nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="Nama_barang" id="Nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
    <label for="kategoriID" class="form-label">Kategori</label>
    <select name="kategoriID" id="kategoriID" class="form-control" required>
        <option value="">Pilih Kategori</option>
        @foreach ($kategories as $category)
            <option value="{{ $category->KategoriID }}">{{ $category->nama_kategori }}</option>
        @endforeach
    </select>
</div>

        <div class="mb-3">
            <label for="Harga_jual" class="form-label">Harga Jual</label>
            <input type="number" name="Harga_jual" id="Harga_jual" class="form-control" required min="0">
        </div>
        <div class="mb-3">
            <label for="Harga_dasar" class="form-label">Harga Dasar</label>
            <input type="number" name="Harga_dasar" id="Harga_dasar" class="form-control" required min="0">
        </div>
        <div class="mb-3">
            <label for="Stok" class="form-label">Stok</label>
            <input type="number" name="Stok" id="Stok" class="form-control" required min="0">
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Kode Barang</label>
            <input type="text" name="code" id="code" class="form-control">
        </div>
        <div class="mb-3">
            <label for="show_in_transaction" class="form-label">Ditampilkan dalam Transaksi</label>
            <select name="show_in_transaction" id="show_in_transaction" class="form-control">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="use_stock" class="form-label">Gunakan Stok</label>
            <select name="use_stock" id="use_stock" class="form-control">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto Barang</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
