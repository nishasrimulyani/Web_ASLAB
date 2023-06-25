<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function soals(){
        return $this->hasMany(Soal::class);
    }

    public function getName($id){
        return $this->where('id',$id)->value('nama');
    }
}
