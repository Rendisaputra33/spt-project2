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
        $data = pabrik::where('kode_pabrik', $req->kode)->first();
        if ($data !== null) {
            return redirect()->back()->with('error', "gagal!, kode $req->kode telah dipakai");
        }
        return pabrik::insert([
            'nama_pabrik' => $req->nama,
            'kode_pabrik' => $req->kode
        ]) ? redirect()->back()->with('sukses', 'data pabrik berhasil di tambahkan')
            : redirect()->back()->with('error', 'data pabrik gagal di tambahkan');
    }
    // update method for update data pabrik
    public function updateMethod(Request $req, $id)
    {
        $data = pabrik::where('kode_pabrik', $req->kode)->first();
        if ($data !== null) {
            if ($data->kode_pabrik === $req->kode && $data->id_pabrik === (int) $id) {
                return $this->saveUpdate($req, $id);
            } elseif ($data->id_pabrik !== (int) $id) {
                return redirect()->back()->with('error', 'kode pabrik ' . $req->kode . ' telah terdaftar');
            } else {
                return $this->saveUpdate($req, $id);
            }
        } else {
            return $this->saveUpdate($req, $id);
        }
    }
    // saving method for updating data
    private function saveUpdate($req, $id)
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

    public function searchMethod($s)
    {
        return response()->json([
            'data' => pabrik::where('nama_pabrik', 'LIKE', '%' . $s . '%')
                ->orWhere('kode_pabrik', 'LIKE', '%' . $s . '%')
                ->get()
        ]);
    }
}
