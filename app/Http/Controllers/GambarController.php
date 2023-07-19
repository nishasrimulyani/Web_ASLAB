<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gambar;
use Illuminate\Support\Facades\Storage;

class GambarController extends Controller
{
    public function index()
    {
        $images = Gambar::latest()->when(request()->q, function($images) {
            $images = $images->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('gambar.index', compact('images'));
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
            'judul'     => 'required',
            'image'     => 'required|mimes:jpeg,jpg,bmp,png',
            'caption'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/images', $image->hashName());

        $image = Gambar::create([
            'judul'     => $request->input('judul'),
            'link'     => $image->hashName(),
            'caption'   => $request->input('caption')
        ]);

        if($image){
            //redirect dengan pesan sukses
            return redirect()->route('gambars.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('gambars.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $image = Gambar::findOrFail($id);
        $link= Storage::disk('local')->delete('public/images/'.$image->link);
        $image->delete();

        $notification = array(
            'message' => 'Gambar berhasil dihapus',
            'alert-type' => 'success'
        );
         return redirect('gambars')->with($notification);

    }
}
