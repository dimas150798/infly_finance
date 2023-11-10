<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Jurnal extends Model
{
    use HasFactory;

    protected $table = 'data_jurnal';
    protected $primaryKey = 'id_jurnal';
    public $timestamps = false;

    protected $fillable = [
        'tanggal_jurnal',
        'nama_akun',
        'reff_jurnal',
        'nominal_jurnal',
        'note_jurnal',
        'status_jurnal'
    ];
}
