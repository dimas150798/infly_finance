<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_BukuBesar extends Model
{
    use HasFactory;

    protected $table = 'buku_besar';
    protected $primaryKey = 'id_bukubesar';
    public $timestamps = false;

    protected $fillable = [
        'id_jurnal',
        'tanggal_jurnal',
        'nama_akun',
        'reff_jurnal',
        'nominal_debit',
        'nominal_kredit',
        'note_jurnal',
        'status_jurnal',
    ];
}
