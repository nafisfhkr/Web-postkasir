@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Daftar Piutang</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Button Trigger Modal for Create -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
        Tambah Piutang
    </button>

    <!-- Table for Piutang -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Transaksi</th>
                <th>Tanggal Piutang</th>
                <th>Jatuh Tempo</th>
                <th>Total Piutang</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($piutang as $item)
            <tr>
                <td>{{ $item->piutangID }}</td>
                <td>{{ $item->customers->nama }}</td>
                <td>{{ $item->transactions->TransaksiID }}</td>
                <td>{{ $item->Tanggal_piutang }}</td>
                <td>{{ $item->Jatuh_tempo }}</td>
                <td>{{ $item->Total_piutang }}</td>
                <td>{{ $item->Status_Pembayaran }}</td>
                <td>
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->piutangID }}">
                        Edit
                    </button>

                    <!-- Delete Form -->
                    <form action="{{ route('piutang.destroy', $item->piutangID) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus piutang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal-{{ $item->piutangID }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Piutang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('piutang.update', $item->piutangID) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="CustomerID" class="form-label">Customer</label>
                                    <select name="CustomerID" class="form-control" required>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->CustomerID }}" {{ $customer->CustomerID == $item->CustomerID ? 'selected' : '' }}>
                                                {{ $customer->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="TransaksiID" class="form-label">Transaksi</label>
                                    <select name="TransaksiID" class="form-control" required>
                                        @foreach ($transactions as $transaction)
                                            <option value="{{ $transaction->TransaksiID }}" {{ $transaction->TransaksiID == $item->TransaksiID ? 'selected' : '' }}>
                                                {{ $transaction->TransaksiID }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="Tanggal_piutang" class="form-label">Tanggal Piutang</label>
                                    <input type="date" name="Tanggal_piutang" class="form-control" value="{{ $item->Tanggal_piutang }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Jatuh_tempo" class="form-label">Jatuh Tempo</label>
                                    <input type="date" name="Jatuh_tempo" class="form-control" value="{{ $item->Jatuh_tempo }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Total_piutang" class="form-label">Total Piutang</label>
                                    <input type="number" name="Total_piutang" class="form-control" value="{{ $item->Total_piutang }}" required>
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
                <h5 class="modal-title" id="createModalLabel">Tambah Piutang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('piutang.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="CustomerID" class="form-label">Customer</label>
                        <select name="CustomerID" class="form-control" required>
                            <option value="">Pilih Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->CustomerID }}">{{ $customer->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="TransaksiID" class="form-label">Transaksi</label>
                        <select name="TransaksiID" class="form-control" required>
                            <option value="">Pilih Transaksi</option>
                            @foreach ($transactions as $transaction)
                                <option value="{{ $transaction->TransaksiID }}">{{ $transaction->TransaksiID }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Tanggal_piutang" class="form-label">Tanggal Piutang</label>
                        <input type="date" name="Tanggal_piutang" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Jatuh_tempo" class="form-label">Jatuh Tempo</label>
                        <input type="date" name="Jatuh_tempo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="Total_piutang" class="form-label">Total Piutang</label>
                        <input type="number" name="Total_piutang" class="form-control" required>
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
@endsection
