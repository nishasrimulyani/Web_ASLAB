<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('catatan_jawaban', 'nilai')->withTimestamps();
    }

    public function soals(){
        return $this->belongsToMany(Soal::class)->withTimestamps();
    }
}
