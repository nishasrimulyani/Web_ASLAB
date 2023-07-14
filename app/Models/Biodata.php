<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getLink($id){
        return $this->where('id',$id)->value('link_cv','link_lamaran','link_gambar');
    }

    public function lowongan(){
        return $this->belongsTo(Lowongan::class);
    }

}
