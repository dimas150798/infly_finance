<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_AkunLogin extends Model
{
    use HasFactory;

    protected $table = 'data_akun';
    protected $primaryKey = 'id_akun';
    public $timestamps = false;

    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'tipe_akun',
        'debet_akun',
        'kredit_akun'
    ];
}
