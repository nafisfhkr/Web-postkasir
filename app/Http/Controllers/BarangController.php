<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar kategori unik untuk dropdown
        $kategoriList = Kategori::pluck('nama_kategori', 'kategoriID');
    
        // Ambil filter kategori dari request
        $kategoriFilter = $request->input('kategori');
    
        // Query data barang
        $query = Barang::query();
        if ($kategoriFilter) {
            $query->where('kategoriID', $kategoriFilter);
        }
    
        $barang = $query->get();
    
        // Jika data kosong, tampilkan pesan error
        if ($barang->isEmpty() || $kategoriList->isEmpty()) {
            return view('barang.index', compact('barang', 'kategoriList'))
                ->withErrors('Data barang atau kategori tidak tersedia.');
        }
    
        return view('barang.index', compact('barang', 'kategoriList'));
    }
    
    

    public function create()
    {
        $kategories = Kategori::all();
        return view('Barang.create', compact('kategories'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan!');
        }
        $kategories = Kategori::all();
        return view('barang.edit', compact('barang', 'kategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Nama_barang' => 'required|string|max:255',
            'kategoriID' => 'required|exists:kategori,kategoriID',
            'Harga_jual' => 'required|numeric|min:0',
            'Harga_dasar' => 'required|numeric|min:0',
            'Stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $barang = Barang::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto'))
         { if ($barang->foto && \Storage::exists('public/' . $barang->foto)) 
        { \Storage::delete('public/' . $barang->foto); } $data['foto'] = $request->file('foto')->store('barang', 'public'); }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_barang' => 'required',
            'kategoriID' => 'required',
            'Harga_jual' => 'required|numeric',
            'Harga_dasar' => 'required|numeric',
            'Stok' => 'required|integer',
        ]);

        $kategori = Kategori::find($request->kategoriID);

        $barang = new Barang();
        $barang->Nama_barang = $request->Nama_barang;
        $barang->kategoriID = $request->kategoriID;
        $barang->kategori = $kategori ? $kategori->nama_kategori : null;
        $barang->Harga_jual = $request->Harga_jual;
        $barang->Harga_dasar = $request->Harga_dasar;
        $barang->Stok = $request->Stok;
        $barang->code = $request->code;
        $barang->show_in_transaction = $request->show_in_transaction;
        $barang->use_stock = $request->use_stock;

        if ($request->hasFile('foto')) 
        { $fotoPath = $request->file('foto')->store('barang', 'public'); 
         $barang->foto = $fotoPath; }

        try {
            $barang->save();
            return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

   public function destroy($id)
{
    try {
        $barang = Barang::findOrFail($id);

        // Hapus file foto jika ada
        if ($barang->foto && \Storage::exists('public/' . $barang->foto)) {
            \Storage::delete('public/' . $barang->foto);
        }

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    } catch (\Exception $e) {
        // Log error dengan detail
        \Log::error('Error saat menghapus barang dengan ID: ' . $id, [
            'error_message' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        return redirect()->route('barang.index')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    }
}


}
