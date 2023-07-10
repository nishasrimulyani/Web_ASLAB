<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $documents = Biodata::latest()->when(request()->q, function($documents) {
            $documents = $documents->where('nama', 'like', '%'. request()->q . '%');
        })->paginate(10);

        $lowongans = new Lowongan();

        return view('biodata.index', compact('documents','lowongans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $lowongans = Lowongan::latest()->get();
        return view('biodata.index', compact('lowongans'));
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'              => 'required|string|max:255',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'jurusan'           => 'required',
            'ipk'               => 'required',
            'lowongan_id'       => 'required',
            'document'          => 'required|mimes:doc,docx,pdf',
        ]);

        //upload document
        $document = $request->file('document');
        $document->storeAs('public/documents', $document->hashName());

        $document = Biodata::create([
            'nama'              => $request->input('nama'),
            'tempat_lahir'      => $request->input('tempat_lahir'),
            'tanggal_lahir'     => $request->input('tanggal_lahir'),
            'jurusan'           => $request->input('jurusan'),
            'ipk'               => $request->input('ipk'),
            'lowongan_id'       => $request->input('lowongan_id'),
            'link_cv'           => $document->hashName(),
            'link_lamaran'      => $document->hashName(),
            'link_gambar'       => $document->hashName(),
        ]);

        if($document){
            //redirect dengan pesan sukses
            return redirect()->route('biodata.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('biodata.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Biodata::findOrFail($id);
        $link= Storage::disk('local')->delete('public/documents/'.$document->link);
        $document->delete();

        if($document){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
