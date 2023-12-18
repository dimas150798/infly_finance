<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Area extends Model
{
    use HasFactory;

    protected $table = 'data_area';
    protected $primaryKey = 'id_area';
    public $timestamps = false;

    protected $fillable = [
        'id_area',
        'nama_area',
    ];
}
