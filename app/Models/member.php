<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    protected $table = 'members';
    protected $primarykey ='id_member';
    public $timestamps = false;

    protected $fillable = ['nama_member', 'alamat', 'jenis_kelamin', 'tlp'];
}
