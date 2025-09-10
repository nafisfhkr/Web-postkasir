<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hutang;
use App\Models\Suplier;

class HutangController extends Controller
{
    public function index()
    {
        $hutang = Hutang::with('supplier')->get(); // Pastikan relasi 'suplier' ikut diload
        $suppliers = Suplier::all();
        return view('hutang.index', compact('hutang', 'suppliers'));
    }
    

    public function create()
    {
        $suppliers = \App\Models\Suplier::all(); // Ambil semua data supplier
        return view('hutang.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'SuplierID' => 'required|exists:supplier,SuplierID',
            'Tanggal_hutang' => 'required|date',
            'Jatuh_tempo' => 'required|date',
            'Total_hutang' => 'required|numeric',
            'Status_Pembayaran' => 'required|string',
        ]);
        

        Hutang::create($validated);

        return redirect()->route('hutang.index');
    }

    public function edit(Hutang $hutang)
    {
        $suppliers = \App\Models\Suplier::all(); 
        return view('hutang.edit', compact('hutang', 'suppliers'));
    }

    public function update(Request $request, Hutang $hutang)
    {
        $validated = $request->validate([
            'SuplierID' => 'required|exists:supplier,SuplierID',
            'Tanggal_hutang' => 'required|date',
            'Jatuh_tempo' => 'required|date',
            'Total_hutang' => 'required|numeric',
            'Status_Pembayaran' => 'required|string',
        ]);
        
        

        $hutang->update($validated);

        return redirect()->route('hutang.index');
    }

    public function destroy(Hutang $hutang)
    {
        $hutang->delete();

        return redirect()->route('hutang.index');
    }
}
