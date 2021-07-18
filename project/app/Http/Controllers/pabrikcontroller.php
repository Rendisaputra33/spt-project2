<?php

namespace App\Http\Controllers;

use App\Models\pabrik;
use Illuminate\Http\Request;

class pabrikcontroller extends Controller
{
    // index method for display data pabrik
    public function indexMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => pabrik::get(),
            'title' => 'Pabrik'
        ]);
    }
    // add method for add data pabrik
    public function addMethod(Request $req)
    {
        return pabrik::insert([
            'nama_pabrik' => $req->nama,
            'kode_pabrik' => $req->kode
        ]) ? redirect()->back()->with('sukses', 'data berhasil di tambahkan')
            : redirect()->back()->with('error', 'data gagal di tambahkan');
    }
    // update method for update data pabrik
    public function updateMethod(Request $req, $id)
    {
        return pabrik::where('id_pabrik', $id)->update([
            'nama_pabrik' => $req->nama,
            'kode_pabrik' => $req->kode
        ]) ? redirect()->back()->with('sukses', 'data berhasil di ubah')
            : redirect()->back()->with('error', 'data gagal di ubah');
    }
    // delete method for delete data pabrik
    public function deleteMethod($id)
    {
        return pabrik::where('id_pabrik', $id)->delete()
            ? redirect()->back()->with('sukses', 'data berhasil di hapus')
            : redirect()->back()->with('error', 'data gagal di hapus');
    }
    // get data update for update data pabrik
    public function getupMethod($id)
    {
        return response()->json([
            'data' => pabrik::where('id_pabrik', $id)->first()
        ]);
    }
}
