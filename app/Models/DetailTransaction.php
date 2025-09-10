<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $table = 'detail_transactions';
    protected $primaryKey = 'detailID';

    protected $fillable = [
        'TransaksiID', 'BarangID', 'Jumlah_barang', 'harga_satuan', 'Subtotal'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'TransaksiID', 'TransaksiID');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'BarangID', 'BarangID');
    }
}
