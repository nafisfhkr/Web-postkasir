@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Daftar Hutang</h2>

    <!-- Button Trigger Modal for Create -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah Hutang
    </button>

    <!-- Table for Hutang -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Supplier</th>
                <th>Tanggal Hutang</th>
                <th>Jatuh Tempo</th>
                <th>Total Hutang</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hutang as $item)
            <tr>
                <td>{{ $item->hutangID }}</td>
                <td>{{ $item->supplier->Nama ?? 'Tidak Ada' }}</td>
                <td>{{ $item->Tanggal_hutang }}</td>
                <td>{{ $item->Jatuh_tempo }}</td>
                <td>{{ number_format($item->Total_hutang, 0, ',', '.') }}</td>
                <td>{{ $item->Status_Pembayaran }}</td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->hutangID }}">Edit</button>

                    <!-- Delete Button -->
                    <form action="{{ route('hutang.destroy', $item->hutangID) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus hutang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal-{{ $item->hutangID}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Hutang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('hutang.update', $item->hutangID) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="SuplierID" class="form-label">Pilih Supplier</label>
                                    <select name="SuplierID" class="form-select" required>
                                        <option value="" disabled>Pilih Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->SuplierID }}" {{ $item->SuplierID == $supplier->SuplierID ? 'selected' : '' }}>
                                                {{ $supplier->Nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="Tanggal_hutang" class="form-label">Tanggal Hutang</label>
                                    <input type="date" name="Tanggal_hutang" class="form-control" value="{{ $item->Tanggal_hutang }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Jatuh_tempo" class="form-label">Jatuh Tempo</label>
                                    <input type="date" name="Jatuh_tempo" class="form-control" value="{{ $item->Jatuh_tempo }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Total_hutang" class="form-label">Total Hutang</label>
                                    <input type="number" name="Total_hutang" class="form-control" value="{{ $item->Total_hutang }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Status_Pembayaran" class="form-label">Status Pembayaran</label>
                                    <input type="text" name="Status_Pembayaran" class="form-control" value="{{ $item->Status_Pembayaran }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Hutang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('hutang.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="SuplierID" class="form-label">Pilih Supplier</label>
                        <select name="SuplierID" class="form-select" required>
                            <option value="" disabled selected>Pilih Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->SuplierID }}">{{ $supplier->Nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Tanggal_hutang" class="form-label">Tanggal Hutang</label>
                        <input type="date" name="Tanggal_hutang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Jatuh_tempo" class="form-label">Jatuh Tempo</label>
                        <input type="date" name="Jatuh_tempo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Total_hutang" class="form-label">Total Hutang</label>
                        <input type="number" name="Total_hutang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Status_Pembayaran" class="form-label">Status Pembayaran</label>
                        <input type="text" name="Status_Pembayaran" class="form-control" required>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
