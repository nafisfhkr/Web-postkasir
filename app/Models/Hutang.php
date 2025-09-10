<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;

    protected $table = 'hutang';
    protected $primaryKey = 'hutangID';

    protected $fillable = [
        'SuplierID',
        'Tanggal_hutang',
        'Jatuh_tempo',
        'Total_hutang',
        'Status_Pembayaran',
    ];
    
    

    public function supplier()
    {
        return $this->belongsTo(Suplier::class, 'SuplierID', 'SuplierID');
    }
}
