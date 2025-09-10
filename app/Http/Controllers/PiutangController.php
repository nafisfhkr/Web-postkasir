<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piutang;
use App\Models\Customer;
use App\Models\Transaction;

class PiutangController extends Controller
{
    public function index()
    {
        $piutang = Piutang::with(['customers', 'transactions'])->get();
        $customers = Customer::all();
        $transactions = Transaction::all();
    
        return view('piutang.index', compact('piutang', 'customers', 'transactions'));
    }
    

    public function create()
    {
        // Ambil data customer dan transaksi untuk dropdown
        $customers = Customer::all();
        $transactions = Transaction::all();

        return view('piutang.create', compact('customers', 'transactions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'CustomerID' => 'required|exists:customers,CustomerID',
            'TransaksiID' => 'required|exists:transactions,TransaksiID',
            'Tanggal_piutang' => 'required|date',
            'Jatuh_tempo' => 'required|date',
            'Total_piutang' => 'required|numeric',
            'Status_Pembayaran' => 'required|string',
        ]);

        Piutang::create($validated);

        return redirect()->route('piutang.index')->with('success', 'Piutang berhasil ditambahkan.');
    }

    public function edit(Piutang $piutang)
    {
        $customers = Customer::all();
        $transactions = Transaction::all();

        return view('piutang.edit', compact('piutang', 'customers', 'transactions'));
    }

    public function update(Request $request, Piutang $piutang)
    {
        $validated = $request->validate([
            'CustomerID' => 'required|exists:customers,CustomerID',
            'TransaksiID' => 'required|exists:transactions,TransaksiID',
            'Tanggal_piutang' => 'required|date',
            'Jatuh_tempo' => 'required|date',
            'Total_piutang' => 'required|numeric',
            'Status_Pembayaran' => 'required|string',
        ]);

        $piutang->update($validated);

        return redirect()->route('piutang.index')->with('success', 'Piutang berhasil diperbarui.');
    }

    public function destroy(Piutang $piutang)
    {
        $piutang->delete();

        return redirect()->route('piutang.index')->with('success', 'Piutang berhasil dihapus.');
    }
}
