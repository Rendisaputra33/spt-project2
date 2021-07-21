<?php

namespace App\Http\Controllers;

use App\Models\entry;
use Illuminate\Http\Request;

class entrycontroller extends Controller
{
    public function indexMethod()
    {
        return view('tampil-data-entry', [
            'data' => entry::get(),
            'title' => 'Entry'
        ]);
    }

    public function addMethod(Request $req)
    {
        return entry::insert([
            'periode' => $req->periode,
            'masa_giling' => $req->masa_giling,
            'id_pabrik' => $req->id_pabrik,
            'reg' => $req->reg,
            'nospta' => $req->nospta,
            'nopol' => $req->nopol,
            'bobot' => $req->bobot,
            'variasi' => $req->variasi,
            'type' => $req->type,
            'keterangan' => $req->keterangan,
            'harga_beli' => $req->harga_beli,
            'hpp' => $req->hpp,
            'sisa' => $req->sisa,
        ])
            ? redirect()->back()->with('sukses', 'data berhasil ditambahkan')
            : redirect()->back()->with('error', 'data gagal ditambahkan');
    }

    public function updateMethod(Request $req, $id)
    {
        return entry::where('id_entry', $id)->update([
            'periode' => $req->periode,
            'masa_giling' => $req->masa_giling,
            'id_pabrik' => $req->id_pabrik,
            'reg' => $req->reg,
            'nospta' => $req->nospta,
            'nopol' => $req->nopol,
            'bobot' => $req->bobot,
            'variasi' => $req->variasi,
            'type' => $req->type,
            'keterangan' => $req->keterangan,
            'harga_beli' => $req->harga_beli,
            'hpp' => $req->hpp,
            'sisa' => $req->sisa,
        ])
            ? redirect()->back()->with('sukses', 'data berhasil ditambahkan')
            : redirect()->back()->with('error', 'data gagal ditambahkan');
    }

    public function deleteMethod($id)
    {
        return entry::where('id_entry', $id)->delete()
            ? redirect()->back()->with('sukses', 'data berhasil di hapus')
            : redirect()->back()->with('error', 'data gagal di hapus');
    }

    public function getupMethod($id)
    {
        return response()->json([
            'data' => entry::where('id_entry', $id)->first()
        ]);
    }
}
