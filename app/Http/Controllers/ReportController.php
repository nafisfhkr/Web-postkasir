<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\LaporanTransaksi;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function transactions(Request $request)
    {
        $filter = $request->input('filter', 'hari'); // Default filter 'hari'
        $tahun = $request->input('tahun');
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');
    
        // Ambil data tahun yang tersedia di database untuk dropdown
        $availableYears = \App\Models\LaporanTransaksi::selectRaw("YEAR(tanggal) as tahun")
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');
    
        $laporanTransaksi = \App\Models\LaporanTransaksi::query();
    
        if ($filter === 'hari') {
            $laporanTransaksi->selectRaw("
                DATE_FORMAT(tanggal, '%Y-%m-%d') as periode,
                SUM(total_transaksi) as total_transaksi,
                SUM(total_pendapatan) as total_pendapatan,
                SUM(jumlah_diskon) as total_diskon
            ")->groupBy('periode');
    
            if ($tanggal) {
                $laporanTransaksi->whereDate('tanggal', $tanggal);
            }
        } elseif ($filter === 'bulan') {
            $laporanTransaksi->selectRaw("
                DATE_FORMAT(tanggal, '%Y-%m') as periode,
                SUM(total_transaksi) as total_transaksi,
                SUM(total_pendapatan) as total_pendapatan,
                SUM(jumlah_diskon) as total_diskon
            ")->groupBy('periode');
    
            if ($bulan && $tahun) {
                $laporanTransaksi->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan);
            }
        } elseif ($filter === 'tahun') {
            $laporanTransaksi->selectRaw("
                YEAR(tanggal) as periode,
                SUM(total_transaksi) as total_transaksi,
                SUM(total_pendapatan) as total_pendapatan,
                SUM(jumlah_diskon) as total_diskon
            ")->groupBy('periode');
    
            if ($tahun) {
                $laporanTransaksi->whereYear('tanggal', $tahun);
            }
        }
    
        $laporanTransaksi = $laporanTransaksi->orderBy('periode', 'desc')->get();
    
        return view('reports.transactions', [
            'laporanTransaksi' => $laporanTransaksi,
            'filter' => $filter,
            'tahun' => $tahun,
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'availableYears' => $availableYears,
        ]);
    }
    

    

    public function financials()
    {
        // Mengambil data laporan keuangan
        $laporanKeuangan = LaporanKeuangan::orderBy('Periode_awal', 'desc')->get();

        // Menampilkan view dengan data laporan keuangan
        return view('reports.financials', compact('laporanKeuangan'));
    }

    // Menyimpan laporan keuangan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Periode_awal' => 'required|date',
            'Periode_akhir' => 'required|date|after_or_equal:Periode_awal',
            'total_pemasukan' => 'required|numeric|min:0',
            'total_pengeluaran' => 'required|numeric|min:0',
        ]);

        $validated['laba_bersih'] = $validated['total_pemasukan'] - $validated['total_pengeluaran'];

        try {
            LaporanKeuangan::create($validated);
            return redirect()->back()->with('success', 'Laporan keuangan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan laporan keuangan.');
        }
    }

    // Menampilkan form untuk mengedit laporan keuangan
    public function edit($id)
    {
        $laporan = LaporanKeuangan::findOrFail($id);
        return view('reports.edit', compact('laporan'));
    }

    // Mengupdate laporan keuangan yang ada
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'Periode_awal' => 'required|date',
            'Periode_akhir' => 'required|date|after_or_equal:Periode_awal',
            'total_pemasukan' => 'required|numeric|min:0',
            'total_pengeluaran' => 'required|numeric|min:0',
        ]);

        $validated['laba_bersih'] = $validated['total_pemasukan'] - $validated['total_pengeluaran'];

        try {
            $laporan = LaporanKeuangan::findOrFail($id);
            $laporan->update($validated);
            return redirect()->back()->with('success', 'Laporan keuangan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui laporan keuangan.');
        }
    }

    // Menghapus laporan keuangan
    public function destroy($id)
    {
        try {
            $laporan = LaporanKeuangan::findOrFail($id);
            $laporan->delete();
            return redirect()->back()->with('success', 'Laporan keuangan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus laporan keuangan.');
        }
    }

}
