@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Kategori</h1>
    <a href="{{ route('kategori.create') }}" class="btn btn-success mb-4">Tambah Kategori</a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach ($kategori as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">{{ $item->nama_kategori }}</h5>
                </div>
                <div class="card-footer bg-white border-0 text-center pb-3">
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('kategori.edit', $item->KategoriID) }}" class="btn btn-primary btn-sm px-3">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('kategori.destroy', $item->KategoriID) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm px-3" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection