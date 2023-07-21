<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use TheSeer\Tokenizer\Exception;
class AhpController extends Controller
{
    public function index()
    {
        $datanilai = DB::table('data_nilais as a')
                    ->join('users as b', 'a.id_user', '=', 'b.id')
                    ->select('a.*', 'b.nama as nama_user')
                    ->get();

        return view('ahp.index', compact('datanilai'));
    }

    public function calculateRanking(Request $request)
    {
        $bobot_psikotest = (float) $request->input('bobot_psikotest');
        $bobot_pengetahuan = (float) $request->input('bobot_pengetahuan');
        $bobot_minat =  (float) $request->input('bobot_minat');        
        $bobot_wawancara = (float) $request->input('bobot_wawancara');

        $bobot = [
            $bobot_psikotest, 
            $bobot_pengetahuan, 
            $bobot_minat, 
            $bobot_wawancara
        ];

        $datanilai = DB::table('data_nilais as a')
                    ->join('users as b', 'a.id_user', '=', 'b.id')
                    ->select('a.*', 'b.nama as nama_user')
                    ->get();

        
        // foreach($datanilai as $row) 
        // {
        //     if (in_array(0, $bobot)) {
        //         throw new Exception("Division by zero error. The 'bobot' array contains a zero value.");
        //     }
        //     // Matriks Kriteria
        //     $matriks_kriteriaxx = [
        //         [$row->nilai_psikotest * ($bobot[0] / $bobot[0]), $row->nilai_pengetahuan * ($bobot[0] / $bobot[1]), $row->nilai_minat * ($bobot[0] / $bobot[2]), $row->nilai_wawancara * ($bobot[0] / $bobot[3])],
        //         [$row->nilai_psikotest * ($bobot[1] / $bobot[0]), $row->nilai_pengetahuan * ($bobot[1] / $bobot[1]), $row->nilai_minat * ($bobot[1] / $bobot[2]), $row->nilai_wawancara * ($bobot[1] / $bobot[3])],
        //         [$row->nilai_psikotest * ($bobot[2] / $bobot[0]), $row->nilai_pengetahuan * ($bobot[2] / $bobot[1]), $row->nilai_minat * ($bobot[2] / $bobot[2]), $row->nilai_wawancara * ($bobot[2] / $bobot[3])],
        //         [$row->nilai_psikotest * ($bobot[3] / $bobot[0]), $row->nilai_pengetahuan * ($bobot[3] / $bobot[1]), $row->nilai_minat * ($bobot[3] / $bobot[2]), $row->nilai_wawancara * ($bobot[3] / $bobot[3])],
                
        //     ];       
        // }

        $matriks_kriteria = [
            [$bobot[0] / $bobot[0], $bobot[0] / $bobot[1], $bobot[0] / $bobot[2], $bobot[0] / $bobot[3]],
            [$bobot[1] / $bobot[0], $bobot[1] / $bobot[1], $bobot[1] / $bobot[2], $bobot[1] / $bobot[3]],
            [$bobot[2] / $bobot[0], $bobot[2] / $bobot[1], $bobot[2] / $bobot[2], $bobot[2] / $bobot[3]],
            [$bobot[3] / $bobot[0], $bobot[3] / $bobot[1], $bobot[3] / $bobot[2], $bobot[3] / $bobot[3]],
            
        ];
        
        $total_kriteria = [
            $matriks_kriteria[0][0] + $matriks_kriteria[1][0] + $matriks_kriteria[2][0] + $matriks_kriteria[3][0],
            $matriks_kriteria[0][1] + $matriks_kriteria[1][1] + $matriks_kriteria[2][1] + $matriks_kriteria[3][1],
            $matriks_kriteria[0][2] + $matriks_kriteria[1][2] + $matriks_kriteria[2][2] + $matriks_kriteria[3][2],
            $matriks_kriteria[0][3] + $matriks_kriteria[1][3] + $matriks_kriteria[2][3] + $matriks_kriteria[3][3],
        ];
        // End Of Matriks Kriteria

        // Matriks normalisasi
        $matriks_normalisasi = [
            [$matriks_kriteria[0][0] / $total_kriteria[0], $matriks_kriteria[0][1] / $total_kriteria[1], $matriks_kriteria[0][2] / $total_kriteria[2], $matriks_kriteria[0][3] / $total_kriteria[3]],
            [$matriks_kriteria[1][0] / $total_kriteria[0], $matriks_kriteria[1][1] / $total_kriteria[1], $matriks_kriteria[1][2] / $total_kriteria[2], $matriks_kriteria[1][3] / $total_kriteria[3]],
            [$matriks_kriteria[2][0] / $total_kriteria[0], $matriks_kriteria[2][1] / $total_kriteria[1], $matriks_kriteria[2][2] / $total_kriteria[2], $matriks_kriteria[2][3] / $total_kriteria[3]],
            [$matriks_kriteria[3][0] / $total_kriteria[0], $matriks_kriteria[3][1] / $total_kriteria[1], $matriks_kriteria[3][2] / $total_kriteria[2], $matriks_kriteria[3][3] / $total_kriteria[3]],
        ];  

        dd($matriks_kriteria, $total_kriteria, $matriks_normalisasi);

        // $pembulatan_normalisasi = [
        //     [round($matriks_normalisasi[0][0], 2), round($matriks_normalisasi[0][1], 2), round($matriks_normalisasi[0][2], 2), round($matriks_normalisasi[0][3], 2)],
        //     [round($matriks_normalisasi[1][0], 2), round($matriks_normalisasi[1][1], 2), round($matriks_normalisasi[1][2], 2), round($matriks_normalisasi[1][3], 2)], 
        //     [round($matriks_normalisasi[2][0], 2), round($matriks_normalisasi[2][1], 2), round($matriks_normalisasi[2][2], 2), round($matriks_normalisasi[2][3], 2)], 
        //     [round($matriks_normalisasi[3][0], 2), round($matriks_normalisasi[3][1], 2), round($matriks_normalisasi[3][2], 2), round($matriks_normalisasi[3][3], 2)] 
        // ];

        
    }
}
