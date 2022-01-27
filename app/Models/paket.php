<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    protected $table = 'pakets';
    protected $primarykey ='id_peket';
    public $timestamps = false;

    protected $fillable = ['jenis', 'harga'];
}
