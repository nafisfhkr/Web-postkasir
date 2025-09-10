<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Pengguna; // Pastikan model ini mengacu pada tabel pengguna

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with('pengguna')->get(); // Pastikan relasi "pengguna" didefinisikan di model Staff
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        $pengguna = Pengguna::all(); // Mengambil semua data dari tabel pengguna
        return view('staff.create', compact('pengguna'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penggunaID' => 'required|exists:pengguna,id', // Validasi di tabel pengguna
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'Jabatan' => 'required|string|max:255',
            'Gaji' => 'required|numeric',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('staff_photos', 'public');
        }

        Staff::create($validated);
        return redirect()->route('staff.index')->with('success', 'Data Staff berhasil ditambahkan');
    }

    public function edit(Staff $staff)
    {
        $pengguna = Pengguna::all(); // Mengambil data pengguna untuk dropdown
        return view('staff.edit', compact('staff', 'pengguna'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'penggunaID' => 'required|exists:pengguna,id', // Validasi di tabel pengguna
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'Jabatan' => 'required|string|max:255',
            'Gaji' => 'required|numeric',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('staff_photos', 'public');
        }

        $staff->update($validated);
        return redirect()->route('staff.index')->with('success', 'Data Staff berhasil diupdate');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->foto) {
            \Storage::delete('public/' . $staff->foto); // Menghapus file foto jika ada
        }

        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Data Staff berhasil dihapus');
    }
}
