<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Barang;
use App\Models\Pengguna;
use App\Models\LaporanTransaksi;
use App\Models\Diskon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $barangs = Barang::all();
        $user = Auth::user();
        $pengguna = $user->pengguna;

        
        $diskons = Diskon::all();

        return view('transactions.index', compact('customers', 'barangs', 'diskons', 'pengguna'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'nullable|string|max:20',
            'barang_id' => 'required|array',
            'quantity' => 'required|array',
            'cash_given' => 'required|numeric',
        ]);

    
        DB::beginTransaction();

        try {
            // Hitung total harga
            $barangIDs = $request->input('barang_id');
            $quantities = $request->input('quantity');
            $barangs = Barang::whereIn('BarangID', $barangIDs)->get();
            $totalHarga = 0;
            $totalDiskon = 0;

            foreach ($barangIDs as $index => $barangID) {
                $barang = $barangs->firstWhere('BarangID', $barangID);
                if (!$barang) continue;

                $hargaSatuan = $barang->Harga_jual;
                $subtotal = $hargaSatuan * $quantities[$index];

                // Periksa diskon yang dipilih
                if ($request->filled('DiskonID')) {
                    $diskon = \App\Models\Diskon::find($request->input('DiskonID'));
                    if ($diskon) {
                        $besarDiskon = $diskon->besar_diskon;
                        $totalDiskon += ($subtotal * $besarDiskon / 100);
                    }
                }

                $totalHarga += $subtotal;
            }

            // Hitung total harga setelah diskon
            $totalHargaSetelahDiskon = $totalHarga - $totalDiskon;

        
            if ($request->cash_given < $totalHargaSetelahDiskon) {
                throw new \Exception('Uang yang diberikan kurang dari total harga setelah diskon!');
            }

            // Simpan customer
            $customer = Customer::create([
                'nama' => $request->customer_name,
                'email' => $request->customer_email,
                'no_hp' => $request->customer_phone,
            ]);

            // Simpan transaksi
            $transaction = Transaction::create([
                'CustomerID' => $customer->CustomerID,
                'total_harga' => $totalHargaSetelahDiskon, 
                'diskon' => $totalDiskon, 
                'Tanggal_transaksi' => now(),
                'metode_pembayaran' => 'Cash',
                'penggunaID' => Auth::id(),
                'cash_given' => $request->input('cash_given'),
            ]);

            
            foreach ($barangIDs as $index => $barangID) {
                $barang = $barangs->firstWhere('BarangID', $barangID);

                $hargaSatuan = $barang->Harga_jual;
                $subtotal = $hargaSatuan * $quantities[$index];

            
                $diskon = 0;
                if ($request->filled('diskon_id')) {
                    $diskonModel = Diskon::find($request->input('diskon_id'));
                    if ($diskonModel) {
                        $diskon = $diskonModel->besar_diskon;
                    }
                }

                $subtotalSetelahDiskon = $subtotal - ($subtotal * $diskon / 100);

            
                $barang->Stok -= $quantities[$index];
                $barang->save();

                
                $transaction->detailTransactions()->create([
                    'BarangID' => $barangID,
                    'Jumlah_barang' => $quantities[$index],
                    'harga_satuan' => $hargaSatuan,
                    'Subtotal' => $subtotalSetelahDiskon,
                    'diskon' => $diskon,
                ]);
            }

            
            $currentDate = now()->format('Y-m-d');
            $laporanTransaksi = LaporanTransaksi::where('tanggal', $currentDate)->first();

            if ($laporanTransaksi) {
                $laporanTransaksi->increment('total_transaksi', 1);
                $laporanTransaksi->increment('total_pendapatan', $totalHargaSetelahDiskon);
                $laporanTransaksi->increment('jumlah_diskon', $totalDiskon);
            } else {
               
LaporanTransaksi::create([
    'tanggal' => now()->format('Y-m-d'), 
    'total_transaksi' => 1, 
    'total_pendapatan' => $transaction->total_harga, 
    'jumlah_diskon' => $transaction->diskon, 
    'penggunaID' => Auth::id(),
]);

            }

        
            DB::commit();

            return view('transactions.post_transaction', ['transaction' => $transaction]);

        } catch (\Exception $e) {
            
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function receipt($id)
    {
        $transactions = Transaction::with('customer', 'detailTransactions.barang')->findOrFail($id);

        return view('transactions.receipt', [
            'transactions' => $transactions,
        ]);
    }
}
