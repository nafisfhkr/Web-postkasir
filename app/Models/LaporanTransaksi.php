<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTransaksi extends Model
{
    use HasFactory;

    protected $table = 'laporan_transaksi';

    protected $primaryKey = 'laporan_transaksiID';

    protected $fillable = [
        'tanggal',
        'total_transaksi',
        'total_pendapatan',
        'jumlah_diskon',
        'penggunaID',
    ];

    public $timestamps = true;

    // Relasi ke pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'penggunaID');
    }
}

