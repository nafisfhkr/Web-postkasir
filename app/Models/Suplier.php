<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'SuplierID';
    public $timestamps = false;

    protected $fillable = ['Nama', 'Alamat', 'Kontak'];

    // Relasi ke tabel suplier_barang
    public function suplierBarang()
    {
        return $this->hasMany(SuplierBarang::class, 'SuplierID', 'SuplierID');
    }

    public function hutang() 
    { return $this->hasMany(Hutang::class, 'SuplierID', 'SuplierID');
}

}
