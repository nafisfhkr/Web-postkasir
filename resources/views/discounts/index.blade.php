@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Diskon</h1>
    <a href="{{ route('diskon.create') }}" class="btn btn-primary mb-3">Tambah Diskon</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Diskon</th>
                <th>Besar Diskon</th>
                <th>Jangka Waktu (hari)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($diskon as $key => $diskon)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $diskon->nama_diskon ?? 'Tidak Ditemukan' }}</td>
                    <td>{{ $diskon->besar_diskon }}%</td>
                    <td>{{ $diskon->jangka_waktu }} hari</td>
                    <td>
                        <a href="{{ route('diskon.edit', $diskon) }}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showModal" data-id="{{ $diskon->DiskonID }}">Show</button>
                        <form action="{{ route('diskon.destroy', $diskon) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus diskon ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Detail Diskon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Diskon:</strong> <span id="modal-nama-diskon"></span></p>
                <p><strong>Besar Diskon:</strong> <span id="modal-besar-diskon"></span>%</p>
                <p><strong>Jangka Waktu:</strong> <span id="modal-jangka-waktu"></span> hari</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const showModal = document.getElementById('showModal');
        showModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');

            fetch(`/diskon/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal-nama-diskon').innerText = data.nama_diskon;
                    document.getElementById('modal-besar-diskon').innerText = data.besar_diskon;
                    document.getElementById('modal-jangka-waktu').innerText = data.jangka_waktu;
                });
        });
    });
</script>
@endsection
