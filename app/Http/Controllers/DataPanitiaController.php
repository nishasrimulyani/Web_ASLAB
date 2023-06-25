<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DataPanitiaController extends Controller
{
    public function index()
    {
        //$user = Auth::user();
        $users = User::all();
        return view('superadmin.datapanitia', compact('users'));
    }

    public function store(Request $request){

        $validate = $request->all([
            'nama' => 'required|max255',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::Create([
            'nama' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $request
        ]);
    }

    public function update(Request $req){
        $users = User::where("id",$req->get('id'))->first();
        $validate = $req->validate([
            'nama' => 'required|max255',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $users->nama = $req->nama;
        $users->username = $req->username;
        $users->email = $req->email;
        $users->password = $req->password;

        $users->save();

        $notification = array(
            'message' => 'Data Panitia berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect('datapanitia')->with($notification);
    }

    public function delete($id){

        $users = User::where("id","=",$id)->delete();

        $notification = array(
            'message' => 'Data Panitia berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect('datapanitia')->with($notification);
        }
}
