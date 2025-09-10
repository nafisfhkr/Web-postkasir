<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;

    protected $table = 'piutang';
    protected $primaryKey = 'piutangID';

    protected $fillable = [
        'CustomerID',
        'TransaksiID',
        'Tanggal_piutang',
        'Jatuh_tempo',
        'Total_piutang',
        'Status_Pembayaran',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID');
    }

    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'TransaksiID', 'TransaksiID');
    }
}

