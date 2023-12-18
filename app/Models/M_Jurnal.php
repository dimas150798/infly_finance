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

    protected $casts = [
        'tanggal_jurnal' => 'date:d-m-Y',
    ];

    protected $fillable = [
        'tanggal_jurnal',
        'nama_akun',
        'reff_jurnal',
        'nominal_jurnal',
        'note_jurnal',
        'status_jurnal',
        'rincian_jurnal',
        'posting_bukubesar'
    ];

    protected static function booted()
    {
        static::retrieved(function ($model) {
            // Mengonversi tanggal_jurnal ke format yang diinginkan tanpa waktu
            $model->tanggal_jurnal = $model->tanggal_jurnal->format('d-m-Y');
        });
    }
}
