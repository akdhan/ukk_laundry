<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet extends Model
{
    protected $table = 'outlets';
    protected $primarykey ='id_outlet';
    public $timestamps = false;

    protected $fillable = ['alamat', 'telp'];
}
