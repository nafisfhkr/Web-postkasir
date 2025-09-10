<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuplierBarang extends Model
{
    use HasFactory;

    protected $table = 'suplier_barang';
    protected $primaryKey = 'SuplierBarangID';
    public $timestamps = false;

    protected $fillable = ['BarangID', 'SuplierID'];

    // Relasi ke tabel suplier
    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'SuplierID', 'SuplierID');
    }
}
