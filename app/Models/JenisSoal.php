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
    ];

    protected $guarded = [];

    public function soals(){
        return $this->hasMany(Soal::class);
    }

    public function getName($id){
        return $this->where('id',$id)->value('nama_soal');
    }
}
