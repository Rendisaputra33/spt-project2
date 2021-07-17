<?php

namespace App\Http\Controllers;

use App\Models\petani;
use Illuminate\Http\Request;

class petanicontroller extends Controller
{
    // index method for display data petani
    public function indexMethod()
    {
        return view('tampil-data-petani', [
            'data' => petani::get(),
            'title' => 'Pabrik'
        ]);
    }
    // add method for add data petani
    public function addMethod(Request $req)
    {
        return petani::insert([
            'nama_petani' => $req->nama,
            'reg' => $req->register,
            'id_pabrik' => $req->pabrik
        ])
            ? redirect()->back()->with('sukses', 'data berhasil di tambahkan')
            : redirect()->back()->with('error', 'data gagal di tambahkan');
    }
    // update method for update data petani
    public function updateMethod(Request $req, $id)
    {
        return petani::where('id_petani', $id)->update([
            'nama_petani' => $req->nama,
            'reg' => $req->register,
            'id_pabrik' => $req->pabrik
        ]) ? redirect()->back()->with('sukses', 'data berhasil di ubah')
            : redirect()->back()->with('error', 'data gagal di ubah');
    }
    // delete method for delete data petani
    public function deleteMethod($id)
    {
        return petani::where('id_petani', $id)->delete()
            ? redirect()->back()->with('sukses', 'data berhasil di hapus')
            : redirect()->back()->with('error', 'data gagal di hapus');
    }
    // get data update for update data petani
    public function getupMethod()
    {
        return response()->json([
            'data' => petani::where('id_petani', request('id'))->first()
        ]);
    }
}
