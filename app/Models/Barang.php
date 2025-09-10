<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'BarangID';

    protected $fillable = [
        'Nama_barang',
        'kategoriID',
        'Harga_jual',
        'Harga_dasar',
        'Stok',
        'show_in_transaction',
        'use_stock',
        'code',
        'kategori',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategoriID', 'id');
    }

    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class, 'BarangID', 'BarangID');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class, 'BarangID', 'BarangID');
    }


    public function supplierBarang()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_barang', 'BarangID', 'SuplierID');
    }

   
    public function transactions()
    {
    return $this->belongsToMany(Transaction::class, 'detail_transactions', 'BarangID', 'TransaksiID')
                ->withPivot('Jumlah_barang', 'harga_satuan', 'Subtotal')
                ->using(DetailTransaction::class);
    }

}
