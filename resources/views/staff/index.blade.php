@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Staff</h1>
    <a href="{{ route('staff.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah Staff</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jabatan</th>
                <th>Gaji</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($staff as $item)
            <tr>
                <td>{{ $item->StaffID }}</td>
                <td>{{ $item->pengguna->Nama ?? 'Nama tidak tersedia' }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->Jabatan }}</td>
                <td>{{ number_format($item->Gaji, 2) }}</td>
                <td>
                    @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px;">
                    @else
                    <span class="text-muted">Tidak ada foto</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('staff.edit', $item->StaffID) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('staff.destroy', $item->StaffID) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data staff tersedia</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
