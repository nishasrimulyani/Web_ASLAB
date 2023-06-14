<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisSoal;

class JenisSoalController extends Controller
{
    public function index()
    {
        //$user = Auth::user();
        $jenis_soals = JenisSoal::all();
        return view('superadmin.jenis', compact('jenis_soals'));
    }

    public function store(Request $request){

        $validate = $request->all([
            'nama_soal' => 'required|max255',
            'jumlah_soal' => 'required',
            'jumlah_minimal_benar' => 'required',
            'total_nilai' => 'required',
            'passing_grade' => 'required',
        ]);

        JenisSoal::Create([
            'nama_soal' => $request->nama_soal,
            'jumlah_soal' => $request->jumlah_soal,
            'jumlah_minimal_benar' => $request->jumlah_minimal_benar,
            'total_nilai' => $request->total_nilai,
            'passing_grade' => $request->passing_grade,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $request
        ]);
    }

    public function update(Request $req){
        $jenis_soals = JenisSoal::where("id",$req->get('id'))->first();
        $validate = $req->validate([
            'nama_soal' => 'required',
            'jumlah_soal' => 'required',
            'jumlah_minimal_benar' => 'required',
            'total_nilai' => 'required',
            'passing_grade' => 'required',
        ]);

        $jenis_soals->nama_soal = $req->nama_soal;
        $jenis_soals->jumlah_soal = $req->jumlah_soal;
        $jenis_soals->jumlah_minimal_benar = $req->jumlah_minimal_benar;
        $jenis_soals->total_nilai = $req->total_nilai;
        $jenis_soals->passing_grade = $req->passing_grade;

        $jenis_soals->save();

        $notification = array(
            'message' => 'Data Jenis Soal berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect('jenis')->with($notification);
    }

    public function delete($id){

        $jenis_soals = JenisSoal::where("id","=",$id)->delete();

        $notification = array(
            'message' => 'Data Jenis Soal berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect('jenis')->with($notification);
        }
}
