<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subjek(){
        return $this->belongsTo(JenisSoal::class);
    }

    public function ujians(){
        return $this->belongsToMany(Ujian::class)->withTimestamps();
    }
}
