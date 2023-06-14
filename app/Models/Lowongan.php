<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_loker',
        'jumlah_yang_dibutuhkan',
    ];

    protected $primaryKey = 'id';
}
