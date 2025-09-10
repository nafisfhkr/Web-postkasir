@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Barang</h1>
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    <!-- Form Filter Kategori -->
    <form method="GET" action="{{ route('barang.index') }}" class="mb-3">
    <label for="kategori" class="form-label">Cari Berdasarkan Kategori :</label>
    <select name="kategori" id="kategori" class="form-select">
        <option value="">Semua Kategori</option>
        @foreach ($kategoriList as $id => $nama)
            <option value="{{ $id }}" {{ request('kategori') == $id ? 'selected' : '' }}>
                {{ $nama }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary mt-2">Filter</button>
</form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Dasar</th>
                <th>Stok</th>
                <th>Show in Transaction</th>
                <th>Use Stock</th>
                <th>Kode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $barangItem)
                <tr>
                    <td>
                        @if ($barangItem->foto)
                            <img src="{{ asset('storage/' . $barangItem->foto) }}" style="width: 75px; height: 75px; object-fit: cover;">
                        @else
                            <span>Tidak Ada Foto</span>
                        @endif
                    </td>
                    <td>{{ $barangItem->Nama_barang }}</td>
                    <td>{{ $barangItem->kategori }}</td>
                    <td>{{ number_format($barangItem->Harga_jual, 0, ',', '.') }}</td>
                    <td>{{ number_format($barangItem->Harga_dasar, 0, ',', '.') }}</td>
                    <td>{{ $barangItem->Stok }}</td>
                    <td>{{ $barangItem->show_in_transaction ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $barangItem->use_stock ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $barangItem->code ?? 'Tidak Ada Kode' }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $barangItem->BarangID) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barang.destroy', $barangItem->BarangID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
