@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Suplier</h2>
    <!-- Tombol Tambah Suplier -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Suplier</button>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Suplier -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kontak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supliers as $index => $suplier)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $suplier->Nama }}</td>
                    <td>{{ $suplier->Alamat }}</td>
                    <td>{{ $suplier->Kontak }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-warning btn-sm edit-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalEdit" 
                            data-id="{{ $suplier->SuplierID }}"
                            data-nama="{{ $suplier->Nama }}"
                            data-alamat="{{ $suplier->Alamat }}"
                            data-kontak="{{ $suplier->Kontak }}">
                            Edit
                        </button>
                        
                        <!-- Form Hapus -->
                        <form action="{{ route('suplier.destroy', $suplier->SuplierID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus suplier?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Suplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('suplier.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="Nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="Alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="Alamat" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Kontak" class="form-label">Kontak</label>
                            <input type="text" class="form-control" name="Kontak" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Suplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="Nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAlamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="editAlamat" name="Alamat" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editKontak" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="editKontak" name="Kontak" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Script untuk mengisi modal edit
    document.addEventListener("DOMContentLoaded", function() {
        const editBtns = document.querySelectorAll('.edit-btn');
        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const alamat = this.getAttribute('data-alamat');
                const kontak = this.getAttribute('data-kontak');

                document.getElementById('editNama').value = nama;
                document.getElementById('editAlamat').value = alamat;
                document.getElementById('editKontak').value = kontak;

                const editForm = document.getElementById('editForm');
                editForm.action = `/suplier/${id}`;
            });
        });
    });
</script>
@endsection
