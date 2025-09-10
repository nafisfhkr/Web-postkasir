<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();  // Menampilkan daftar barang dengan stok
        return view('stok.index', compact('barangs'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update([
            'Stok' => $request->Stok,
        ]);

        return redirect()->route('stok.index')->with('success', 'Stok berhasil diperbarui');
    }
}
