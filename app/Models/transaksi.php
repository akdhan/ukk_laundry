<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksis';
    protected $primarykey ='id_transaksi';
    protected $dates = ['tgl', 'batas_waktu'];
    public $timestamps = false;

    protected $fillable = ['id_member','id_paket','qty', 'tgl', 'batas_waktu' , 'status', 'dibayar', 'id_user'];
}
