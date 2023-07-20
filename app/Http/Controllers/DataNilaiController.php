<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DataNilai;
use DB;
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

    public function update(Request $request, $id)
    {
        $nilai = DataNilai::findOrFail($id);

        // $validate = $request->validate([
        //   'nilai_wawancara' => 'required'
        // ]);

        $nilai->nilai_wawancara = $request->nilai_wawancara;

        $nilai->update();

        $notification = array(
          'message' => 'Data Nilai berhasil diubah',
          'alert-type' => 'success'
      );

      return response()->json($notification);
    }
}
