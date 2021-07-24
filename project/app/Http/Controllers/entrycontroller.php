<?php

namespace App\Http\Controllers;

use App\Models\entry;
use App\Models\pabrik;
use App\Models\petani;
use App\Models\type;
use App\Models\variasi;
use Illuminate\Http\Request;

class entrycontroller extends Controller
{
    public function indexMethod()
    {
        return view('tampil-data-entry', [
            'data' => entry::whereDate('created_at', now())->get(),
            'type' => type::get(),
            'variasi' => variasi::get(),
            'petani' => petani::get(),
            'pabrik' => pabrik::select('id_pabrik', 'nama_pabrik')->get(),
            'title' => 'Entry'
        ]);
    }

    public function addMethod(Request $req)
    {
        return entry::insert([
            'periode' => $req->periode,
            'masa_giling' => $req->masa,
            'id_pabrik' => $req->pabrik,
            'reg' => $req->reg,
            'nospta' => $req->nospta,
            'nopol' => $req->nopol,
            'bobot' => $req->bobot,
            'variasi' => $req->variasi,
            'type' => $req->type,
            'keterangan' => $req->keterangan,
            'harga_beli' => str_replace('.', '', explode(' ', $req->harga_beli)[1]),
            'hpp' => str_replace('.', '', explode(' ', $req->hpp)[1]),
            'sisa' => str_replace('.', '', explode(' ', $req->sisa)[1]),
        ])
            ? redirect()->back()->with('sukses', 'data berhasil ditambahkan')
            : redirect()->back()->with('error', 'data gagal ditambahkan');
    }

    public function updateMethod(Request $req, $id)
    {
        return entry::where('id_entry', $id)->update([
            'periode' => $req->periode,
            'masa_giling' => $req->masa,
            'id_pabrik' => $req->pabrik,
            'reg' => $req->reg,
            'nospta' => $req->nospta,
            'nopol' => $req->nopol,
            'bobot' => $req->bobot,
            'variasi' => $req->variasi,
            'type' => $req->type,
            'keterangan' => $req->keterangan,
            'harga_beli' => str_replace('.', '', explode(' ', $req->harga_beli)[1]),
            'hpp' => str_replace('.', '', explode(' ', $req->hpp)[1]),
            'sisa' => str_replace('.', '', explode(' ', $req->sisa)[1]),
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

    public function searchMethod($s)
    {
        return response()->json([
            'data' => entry::where('periode', 'LIKE', '%' . $s . '%')
                ->orWhere('masa_giling', 'LIKE', '%' . $s . '%')
                ->orWhere('reg', 'LIKE', '%' . $s . '%')
                ->orWhere('nospta', 'LIKE', '%' . $s . '%')
                ->orWhere('nopol', 'LIKE', '%' . $s . '%')
                ->orWhere('variasi', 'LIKE', '%' . $s . '%')
                ->orWhere('type', 'LIKE', '%' . $s . '%')
                ->get()
        ]);
    }
}
