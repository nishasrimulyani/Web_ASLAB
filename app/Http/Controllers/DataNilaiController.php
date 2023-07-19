<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class DataNilaiController extends Controller
{
    public function index () {
      $datanilai = DB::table('data_nilais as a')
            ->join('users as b', 'a.id_user', '=', 'b.id')
            ->select('a.*', 'b.nama as nama_user')
            ->paginate(10);

      // dd($datanilai);
      return view('datanilais.index', compact('datanilai'));
    }
}
