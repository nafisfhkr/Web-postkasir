@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Manajemen Stok</h1>
    
    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tabel Stok Barang -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama Barang</th>
                <th class="text-center">Stok</th>
                <th class="text-center">Update Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $barang)
                <tr>
                    <td>{{ $barang->Nama_barang }}</td>
                    <td class="text-center">{{ $barang->Stok }}</td>
                    <td class="text-center">
                        <form action="{{ route('stok.update', $barang->BarangID) }}" method="POST" class="d-flex justify-content-center align-items-center">
                            @csrf
                            @method('PUT')
                            <div class="input-group" style="max-width: 200px;">
                                <input type="number" name="Stok" class="form-control" value="{{ $barang->Stok }}" required>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
