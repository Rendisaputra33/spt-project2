<?php

namespace App\Http\Controllers;

use App\Models\pengirim;
use Illuminate\Http\Request;

class pengirimcontroller extends Controller
{
    public function index(Request $req)
    {
        $data = [
            'pengirim' => pengirim::get(),
            'title' => 'Pengirim'
        ];

        return view('tampil-data-pengirim', $data);
    }
    // method update data pengirim
    public function update($id, Request $req)
    {
        if (!$req->validate(['nama' => 'required'])) :
            return redirect()->back();
        endif;

        $updata = pengirim::where('id_pengirim', $id)->update(['nama_pengirim' => $req->nama]);
        return $updata ? redirect()->back()->with('sukses', 'berhasil update data!') : redirect()->back()->with('error', 'gagal update data!');
    }
    // method add data pengirim
    public function add(Request $req)
    {
        if (!$req->validate(['nama' => 'required'])) :
            return redirect()->back();
        endif;

        $adddata = pengirim::insert($req->all());
        return $adddata ? redirect()->back()->with('sukses', 'berhasil menambah data!') : redirect()->back()->with('error', 'gagal menambah data!');
    }
    // method delete data pengirim
    public function delete($id)
    {
        $delete = pengirim::where('id_pengirim', $id)->delete();
        return $delete ? redirect()->back()->with('sukses', 'berhasil menghapus data!') : redirect()->back()->with('error', 'gagal menghapus data!');
    }
}
