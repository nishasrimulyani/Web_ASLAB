<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSoal extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_soal',
        'jumlah_soal',
        'jumlah_minimal_benar',
        'total_nilai',
        'passing_grade',
    ];
}
