<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // Menampilkan daftar diskon
    public function index()
    {
        $diskon = Diskon::all(); // Tidak ada relasi barang, hanya mengambil data diskon
        return view('discounts.index', compact('diskon'));
    }

    // Menampilkan form untuk membuat diskon baru
    public function create()
    {
        return view('discounts.create'); // Tidak membutuhkan data barang
    }

    // Menyimpan diskon baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'besar_diskon' => 'required|numeric|min:0|max:100',
            'jangka_waktu' => 'required|integer|min:1',
        ]);

        Diskon::create([
            'nama_diskon' => $request->nama_diskon,
            'besar_diskon' => $request->besar_diskon,
            'jangka_waktu' => $request->jangka_waktu,
        ]);

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil ditambahkan!');
    }

    // Menampilkan detail diskon berdasarkan ID
    public function show($id)
    {
        $diskon = Diskon::find($id); // Tidak ada relasi barang
        if (!$diskon) {
            return response()->json(['error' => 'Diskon tidak ditemukan.'], 404);
        }
        return response()->json($diskon);
    }

    // Menampilkan form untuk mengedit diskon
    public function edit(Diskon $diskon)
    {
        return view('discounts.edit', compact('diskon'));
    }

    // Memperbarui diskon di database
    public function update(Request $request, Diskon $diskon)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'besar_diskon' => 'required|numeric|min:0|max:100',
            'jangka_waktu' => 'required|integer|min:1',
        ]);

        $diskon->update([
            'nama_diskon' => $request->nama_diskon,
            'besar_diskon' => $request->besar_diskon,
            'jangka_waktu' => $request->jangka_waktu,
        ]);

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil diperbarui!');
    }

    // Menghapus diskon dari database
    public function destroy(Diskon $diskon)
    {
        $diskon->delete();
        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil dihapus!');
    }
}
