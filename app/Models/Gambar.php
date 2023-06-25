<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getLink($id){
        return $this->where('id',$id)->value('link');
    }
}
