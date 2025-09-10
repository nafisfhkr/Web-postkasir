@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Keuangan</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol untuk membuka modal tambah laporan -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addFinancialReportModal">Tambah Laporan Keuangan</button>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Periode Awal</th>
                <th>Periode Akhir</th>
                <th>Total Pemasukan</th>
                <th>Total Pengeluaran</th>
                <th>Laba Bersih</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporanKeuangan as $index => $laporan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($laporan->Periode_awal)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($laporan->Periode_akhir)->format('d M Y') }}</td>
                <td>Rp {{ number_format($laporan->total_pemasukan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($laporan->total_pengeluaran, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($laporan->laba_bersih, 0, ',', '.') }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editFinancialReportModal{{ $laporan->laporanKeuanganID }}">Edit</button>
                    <form action="{{ route('reports.financials.destroy', $laporan->laporanKeuanganID) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit Laporan Keuangan -->
            <div class="modal fade" id="editFinancialReportModal{{ $laporan->laporanKeuanganID }}" tabindex="-1" aria-labelledby="editFinancialReportModalLabel{{ $laporan->laporanKeuanganID }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('reports.financials.update', $laporan->laporanKeuanganID) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editFinancialReportModalLabel{{ $laporan->laporanKeuanganID }}">Edit Laporan Keuangan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="Periode_awal" class="form-label">Periode Awal</label>
                                    <input type="date" class="form-control" id="Periode_awal" name="Periode_awal" value="{{ $laporan->Periode_awal }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Periode_akhir" class="form-label">Periode Akhir</label>
                                    <input type="date" class="form-control" id="Periode_akhir" name="Periode_akhir" value="{{ $laporan->Periode_akhir }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="total_pemasukan" class="form-label">Total Pemasukan</label>
                                    <input type="number" class="form-control" id="total_pemasukan" name="total_pemasukan" value="{{ $laporan->total_pemasukan }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="total_pengeluaran" class="form-label">Total Pengeluaran</label>
                                    <input type="number" class="form-control" id="total_pengeluaran" name="total_pengeluaran" value="{{ $laporan->total_pengeluaran }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Laporan Keuangan -->
<div class="modal fade" id="addFinancialReportModal" tabindex="-1" aria-labelledby="addFinancialReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('reports.financials.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFinancialReportModalLabel">Tambah Laporan Keuangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Periode_awal" class="form-label">Periode Awal</label>
                        <input type="date" class="form-control" id="Periode_awal" name="Periode_awal" required>
                    </div>
                    <div class="mb-3">
                        <label for="Periode_akhir" class="form-label">Periode Akhir</label>
                        <input type="date" class="form-control" id="Periode_akhir" name="Periode_akhir" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_pemasukan" class="form-label">Total Pemasukan</label>
                        <input type="number" class="form-control" id="total_pemasukan" name="total_pemasukan" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_pengeluaran" class="form-label">Total Pengeluaran</label>
                        <input type="number" class="form-control" id="total_pengeluaran" name="total_pengeluaran" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
