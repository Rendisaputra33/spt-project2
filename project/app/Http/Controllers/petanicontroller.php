<?php

namespace App\Http\Controllers;

use App\Models\pabrik;
use App\Models\petani;
use Illuminate\Http\Request;

class petanicontroller extends Controller
{
    // index method for display data petani
    public function indexMethod()
    {
        return view('tampil-data-petani', [
            'data' => petani::rightJoin('mstr_pabrik', 'mstr_petani.id_pabrik', '=', 'mstr_pabrik.id_pabrik')->get(),
            'pabrik' => pabrik::get(),
            'title' => 'Petani'
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
    public function getupMethod($id)
    {
        return response()->json([
            'data' => petani::where('id_petani', $id)->first()
        ]);
    }

    public function searchMethod($s)
    {
        return response()->json([
            'data' => petani::rightJoin('mstr_pabrik', 'mstr_petani.id_pabrik', '=', 'mstr_pabrik.id_pabrik')
                ->where('nama_petani', 'LIKE', '%' . $s . '%')
                ->orWhere('reg', 'LIKE', '%' . $s . '%')
                ->orWhere('nama_pabrik', 'LIKE', '%' . $s . '%')
                ->get()
        ]);
    }
}
