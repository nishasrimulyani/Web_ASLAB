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
        ]);

        JenisSoal::Create([
            'nama_soal' => $request->nama_soal,
            'jumlah_soal' => $request->jumlah_soal,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $request
        ]);
    }

    public function update(Request $req, $id){
        $jenis_soals = JenisSoal::findOrFail($id);
        
        $validate = $req->validate([
            'nama_soal' => 'required',
            'jumlah_soal' => 'required',
        ]);

        $jenis_soals->nama_soal = $req->nama_soal;
        $jenis_soals->jumlah_soal = $req->jumlah_soal;

        $jenis_soals->update();

        $notification = array(
            'message' => 'Data Jenis Soal berhasil diubah',
            'alert-type' => 'success'
        );

        return response()->json($notification);
    }

    public function delete($id){

        $jenis_soals = JenisSoal::where("id","=",$id)->delete();

        $notification = array(
            'message' => 'Data Jenis Soal berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect('jenis')->with('success', 'Data Jenis Soal berhasil dihapus');
        }
}
