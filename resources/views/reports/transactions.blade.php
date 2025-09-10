@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Laporan Transaksi</h2>

    <!-- Filter -->
    <form method="GET" action="{{ route('reports.transactions') }}" class="mb-4">
        <div class="row">
            <!-- Filter Berdasarkan -->
            <div class="col-md-3">
                <label for="filter" class="form-label">Filter Berdasarkan</label>
                <select name="filter" id="filter" class="form-select" onchange="toggleFilterInputs()">
                    <option value="hari" {{ $filter === 'hari' ? 'selected' : '' }}>Harian</option>
                    <option value="bulan" {{ $filter === 'bulan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahun" {{ $filter === 'tahun' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>

            <!-- Filter Tanggal -->
            <div class="col-md-3" id="filter-tanggal" style="display: none;">
                <label for="tanggal" class="form-label">Pilih Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $tanggal }}">
            </div>

            <!-- Filter Bulan -->
            <div class="col-md-3" id="filter-bulan" style="display: none;">
                <label for="bulan" class="form-label">Pilih Bulan</label>
                <select name="bulan" id="bulan" class="form-select">
                    <option value="">-- Pilih Bulan --</option>
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Tahun -->
            <div class="col-md-3" id="filter-tahun">
                <label for="tahun" class="form-label">Pilih Tahun</label>
                <select name="tahun" id="tahun" class="form-select">
                    <option value="">-- Pilih Tahun --</option>
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Tabel Laporan -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Periode</th>
                <th>Total Transaksi</th>
                <th>Total Pendapatan</th>
                <th>Total Diskon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanTransaksi as $laporan)
            <tr>
                <td>{{ $laporan->periode }}</td>
                <td>{{ $laporan->total_transaksi }}</td>
                <td>Rp {{ number_format($laporan->total_pendapatan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($laporan->total_diskon, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Script untuk toggle filter -->
<script>
    function toggleFilterInputs() {
        const filter = document.getElementById('filter').value;

        document.getElementById('filter-tanggal').style.display = filter === 'hari' ? 'block' : 'none';
        document.getElementById('filter-bulan').style.display = filter === 'bulan' ? 'block' : 'none';
        document.getElementById('filter-tahun').style.display = filter !== 'hari' ? 'block' : 'none';
    }

    // Panggil saat halaman dimuat untuk menyesuaikan tampilan awal
    toggleFilterInputs();
</script>
@endsection
