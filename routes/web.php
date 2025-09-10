<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\PiutangController;

Route::get('/', function () {
    return view('welcome');
});

// Route default untuk halaman dashboard Laravel Breeze
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/picture', [ProfileController::class, 'updatePicture'])->name('profile.update.picture');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Route untuk halaman transaksi
    Route::resource('transactions', TransaksiController::class);
    Route::get('/transactions/{id}/receipt', [TransaksiController::class, 'receipt'])->name('transactions.receipt');
    Route::get('/transactions/{id}/print', [TransactionController::class, 'print'])->name('transactions.print');




    
    // Route untuk halaman laporan
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

// Route untuk laporan transaksi
Route::get('/reports/transactions', [ReportController::class, 'transactions'])->name('reports.transactions');

// Route untuk laporan keuangan
Route::get('/reports/financials', [ReportController::class, 'financials'])->name('reports.financials');
Route::post('/reports/financials/store', [ReportController::class, 'store'])->name('reports.financials.store');
Route::get('/reports/financials/{id}/edit', [ReportController::class, 'edit'])->name('reports.financials.edit');
Route::put('/reports/financials/{id}', [ReportController::class, 'update'])->name('reports.financials.update');
Route::delete('/reports/financials/{id}', [ReportController::class, 'destroy'])->name('reports.financials.destroy');



    Route::get('barang', [BarangController::class, 'index'])->name('barang.index'); // Tampilkan daftar barang
    Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create'); // Form tambah barang
    Route::post('barang', [BarangController::class, 'store'])->name('barang.store'); // Simpan barang baru
    Route::get('barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit'); // Form edit barang
    Route::put('barang/{id}', [BarangController::class, 'update'])->name('barang.update'); // Update barang
    Route::delete('barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Hapus barang

    Route::put('stok/{id}', [StokController::class, 'update'])->name('stok.update');
    Route::get('stok', [StokController::class, 'index'])->name('stok.index');

   Route::resource('diskon', DiscountController::class);

   Route::resource('kategori', KategoriController::class);

   Route::resource('staff', StaffController::class);

   Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
   Route::put('/customers/update', [CustomerController::class, 'update'])->name('customers.update');
   
   Route::resource('suplier', SuplierController::class);

   Route::resource('hutang', HutangController::class);
   Route::resource('piutang', PiutangController::class);

   

});

require __DIR__.'/auth.php';
