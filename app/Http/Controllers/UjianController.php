<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ujian;
use App\Models\User;
use App\Models\Gambar;
use App\Models\JenisSoal;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;


class UjianController extends Controller
{
    public function index()
    {
        $exams = Ujian::latest()->when(request()->q, function($exams) {
            $exams = $exams->where('nama', 'like', '%'. request()->q . '%');
        })->paginate(10);
        $currentUser = User::findOrFail(Auth()->id());
        if($currentUser->hasRole('admin')){
            $exams = Ujian::latest()->when(request()->q, function($exams) {
                $exams = $exams->where('nama', 'like', '%'. request()->q . '%');
            })->paginate(10);
        }elseif($currentUser->hasRole('peserta')){
            $exams = Ujian::whereHas('users', function (Builder $query) {
                $query->where('user_id', Auth()->id());
            })->paginate(10);
        }elseif($currentUser->hasRole('panitia')){
            $exams = Ujian::where('dibuat_oleh', Auth()->id())->latest()->when(request()->q, function($exams) {
                $exams = $exams->where('dibuat_oleh', Auth()->id())->where('nama', 'like', '%'. request()->q . '%');
            })->paginate(10);
        }
        
        $user = new User();

        return view('ujian.index', compact('exams','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ujian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'waktu'         => 'required',
            'total_soal'    => 'required',
            'mulai'         => 'required',
            'selesai'       => 'required'
        ]);

        $exam = Ujian::create([
            'nama'          => $request->input('nama'),
            'waktu'         => $request->input('waktu'),
            'total_soal'    => $request->input('total_soal'),
            'status'        => 'Siap',
            'mulai'         => $request->input('mulai'),
            'selesai'       => $request->input('selesai'),
            'dibuat_oleh'   => Auth()->id()
        ]);

        $exam->soals()->sync($request->input('questions'));

        if($exam){
            //redirect dengan pesan sukses
            return redirect()->route('ujians.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('ujians.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ujian $exam)
    {
        $questions = $exam->soals()->where('ujian_id', $exam->id)->get();
        
        return view('ujian.edit', compact('exam', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ujian $exam)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'waktu'         => 'required',
            'total_soal'    => 'required',
            'mulai'         => 'required',
            'selesai'       => 'required'
        ]);

        $exam->update([
            'nama'          => $request->input('nama'),
            'waktu'         => $request->input('waktu'),
            'total_soal'    => $request->input('total_soal'),
            'mulai'         => $request->input('mulai'),
            'selesai'       => $request->input('selesai'),
            'dibuat_oleh'   => Auth()->id()
        ]);

        $exam->soals()->sync($request->input('questions'));

        if($exam){
            //redirect dengan pesan sukses
            return redirect()->route('ujians.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('ujians.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Show the form for detailing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ujian $ujian)
    {
        $questions = $ujian->soals()->where('ujian_id', $ujian->id)->get();
        
        return view('ujian.show', compact('ujian', 'questions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $exam = Ujian::findOrFail($id);
        $exam->delete();

        $notification = array(
            'message' => 'Data Ujian berhasil dihapus',
            'alert-type' => 'success'
        );
         return redirect('ujians')->with($notification);
    }

    public function start($id)
    {
        $exam = Ujian::findOrFail($id);
        $exam_questions = $exam->soals;

        if ($exam_questions->count() == 0) {
            return back()->with(['error' => 'Belum ada Pertanyaan']);
        }
        return view('ujian.start', compact('id'));
    }

    public function result($score, $userId, $examId)
    {
        $user = User::findOrFail($userId);
        $exam = Ujian::findOrFail($examId);
        return view('ujian.result', compact('score', 'user', 'exam'));
    }

    public function peserta($id)
    {
        $exam = Ujian::findOrFail($id);
        return view('ujian.student', compact('exam'));
    }

    public function assign(Request $request, $id)
    {
        $exam = Ujian::findOrFail($id);

        $exam->users()->sync($request->input('pesertas'));

        return redirect('/ujians');

    }

    public function review($userId, $examId)
    {
        return view('ujian.review', compact('userId', 'examId'));
    }
}
