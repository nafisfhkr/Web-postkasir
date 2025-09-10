<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_keuangan'; // Nama tabel di database

    protected $primaryKey = 'laporanKeuanganID'; // Primary key tabel

    protected $fillable = [
        'Periode_awal',
        'Periode_akhir',
        'total_pemasukan',
        'total_pengeluaran',
        'laba_bersih',
    ];

    public $timestamps = false; // Tidak menggunakan created_at dan updated_at
}
