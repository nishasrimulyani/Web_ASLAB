<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataNilai extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'id_user', 'nilai_pengetahuan', 'nilai_minat', 'nilai_psikotest', 'nilai_wawancara'
    ];
}
