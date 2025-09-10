<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'TransaksiID';

    protected $fillable = [
        'penggunaID','CustomerID', 'Tanggal_transaksi', 'total_harga','cash_given','metode_pembayaran','diskon'
    ];

    // Relasi ke Pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'penggunaID', 'id');
    }

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID');
    }

    // Relasi ke DetailTransaction
    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class, 'TransaksiID', 'TransaksiID');
    }


    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'detail_transactions', 'TransaksiID', 'BarangID')
                    ->withPivot('Jumlah_barang', 'harga_satuan', 'Subtotal')
                    ->using(DetailTransaction::class);
    }

    public function piutang()
{
    return $this->hasOne(Piutang::class, 'TransaksiID', 'TransaksiID');
}
}
