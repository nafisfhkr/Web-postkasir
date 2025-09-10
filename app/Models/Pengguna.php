<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'id';

    protected $fillable = [
        'Nama', 'Password', 'Code_referral', 'Role', 'Email', 'No_hp','user_id',
    ];

    public function staff()
    {
        return $this->hasOne(Staff::class, 'penggunaID', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'penggunaID', 'id');
    }

    public function laporanTransaksi()
    {
        return $this->hasMany(LaporanTransaksi::class, 'penggunaID', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
