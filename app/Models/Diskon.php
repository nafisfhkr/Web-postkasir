<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;


    protected $table = 'diskon';


    protected $primaryKey = 'DiskonID';


    protected $fillable = [
        'nama_diskon',   
        'besar_diskon',    
        'jangka_waktu',    
    ];

    
    public $timestamps = true;

}
