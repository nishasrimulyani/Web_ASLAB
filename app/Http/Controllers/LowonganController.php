<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;

class LowonganController extends Controller
{
    public function index()
    {
        //$user = Auth::user();
        $lowongans = Lowongan::all();
        return view('superadmin.lowongan', compact('lowongans'));
    }

    public function store(Request $request){

        $validate = $request->all([
            'nama_loker' => 'required|max255',
            'jumlah_yang_dibutuhkan' => 'required',
        ]);

        Lowongan::Create([
            'nama_loker' => $request->nama_loker,
            'jumlah_yang_dibutuhkan' => $request->jumlah_yang_dibutuhkan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $request
        ]);
    }

    public function update(Request $req){
        $lowongans = Lowongan::where("id",$req->get('id'))->first();
        $validate = $req->validate([
            'nama_loker' => 'required',
            'jumlah_yang_dibutuhkan' => 'required',
        ]);


        $lowongans->nama_loker = $req->nama_loker;
        $lowongans->jumlah_yang_dibutuhkan = $req->jumlah_yang_dibutuhkan;

        $lowongans->save();

        $notification = array(
            'message' => 'Data Lowongan berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect('lowongan')->with($notification);
    }

    public function delete($id){

        $lowongans = Lowongan::where("id","=",$id)->delete();

        $notification = array(
            'message' => 'Data Lowongan berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect('lowongan')->with($notification);
        }
}
