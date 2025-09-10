<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'CustomerID';

    protected $fillable = [
        'nama', 'email', 'no_hp'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'CustomerID', 'CustomerID');
    }

    public function piutang()
{
    return $this->hasMany(Piutang::class, 'CustomerID', 'CustomerID');
}
}
