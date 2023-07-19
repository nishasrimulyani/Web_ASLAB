<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\JenisSoal;
use App\Models\Soal;
use App\Models\User;
use Illuminate\Http\Request;

class SoalController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Soal::latest()->when(request()->q, function($questions) {
            $questions = $questions->where('detail', 'like', '%'. request()->q . '%');
        })->paginate(10);

        $subject = new JenisSoal();
        $image = new Gambar();
        $user = new User();

        $selectSubject = JenisSoal::latest()->get();
        $selectImage = Gambar::latest()->get();

        return view('soal.index', compact('questions', 'subject', 'image', 'user', 'selectSubject', 'selectImage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = JenisSoal::latest()->get();
        $images = Gambar::latest()->get();
        return view('soal.create', compact('subjects', 'images'));
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
            'jenis_id'  => 'required',
            'detail'      => 'required',
            'option_A'    => 'required',
            'option_B'    => 'required',
            'option_C'    => 'required',
            'option_D'    => 'required',
            'jawaban'      => 'required',
            'penjelasan' => 'required'
        ]);

        $question = Soal::create([
            'jenis_id'    => $request->input('jenis_id'),
            'detail'        => htmlspecialchars($request->input('detail')),
            'option_A'      => $request->input('option_A'),
            'option_B'      => $request->input('option_B'),
            'option_C'      => $request->input('option_C'),
            'option_D'      => $request->input('option_D'),
            'jawaban'        => $request->input('jawaban'),
            'penjelasan'   => $request->input('penjelasan'),
            'dibuat_oleh'    => Auth()->id()
        ]);


        if($question){
            //redirect dengan pesan sukses
            return redirect()->route('soals.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('soals.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal $question)
    {
        $subjects = JenisSoal::latest()->get();
        $images = Gambar::latest()->get();
        return view('soal.edit', compact('question','subjects', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soal $question)
    {
        $this->validate($request, [
            'jenis_id'    => 'required',
            'detail'      => 'required',
            'option_A'    => 'required',
            'option_B'    => 'required',
            'option_C'    => 'required',
            'option_D'    => 'required',
            'jawaban'      => 'required',
            'penjelasan' => 'required'
        ]);

        $question = Soal::findOrFail($question->id);

        $question->update([
            'jenis_id'    => $request->input('jenis_id'),
            'detail'        => $request->input('detail'),
            'option_A'      => $request->input('option_A'),
            'option_B'      => $request->input('option_B'),
            'option_C'      => $request->input('option_C'),
            'option_D'      => $request->input('option_D'),
            'image_id'      => $request->input('image_id'),
            'jawaban'        => $request->input('jawaban'),
            'penjelasan'   => $request->input('penjelasan'),
            'dibuat_oleh'    => Auth()->id()
        ]);

        if($question){
            //redirect dengan pesan sukses
            return redirect()->route('soals.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('soals.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $question = Soal::findOrFail($id);
        $question->delete();

        $notification = array(
            'message' => 'Data Jenis Soal berhasil dihapus',
            'alert-type' => 'success'
        );
         return redirect('soals')->with($notification);
    }
}
