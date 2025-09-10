<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Pengguna;
use App\Models\LaporanTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    
    $totalUsers = Pengguna::count();

    
    $totalTransactions = Transaction::count();


    $totalRevenue = Transaction::sum('total_harga');


    $transactions = LaporanTransaksi::select('tanggal', 'total_transaksi', 'total_pendapatan')
                                    ->orderBy('tanggal', 'asc')
                                    ->get();


    $labels = $transactions->pluck('tanggal')->toArray();
    $totalTransaksiData = $transactions->pluck('total_transaksi')->toArray();
    $totalPendapatanData = $transactions->pluck('total_pendapatan')->toArray();


    $currentYear = now()->year;
    $customerData = DB::table('customers')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get();


    $customerLabels = [];
    $customerCounts = [];
    foreach (range(1, 12) as $month) {
        $customerLabels[] = now()->startOfYear()->month($month)->format('F'); // Nama bulan
        $customerCounts[] = $customerData->firstWhere('month', $month)->count ?? 0;
    }

    return view('dashboard.index', compact(
        'totalUsers',
        'totalTransactions',
        'totalRevenue',
        'labels',
        'totalTransaksiData',
        'totalPendapatanData',
        'customerLabels',
        'customerCounts'
    ));
}

    
}