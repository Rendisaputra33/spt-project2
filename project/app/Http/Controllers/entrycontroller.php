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
    public function indexMethod(Request $req)
    {
        if ($req->query('tgl') !== null) {
            $tgl = explode('|', $req->query('tgl'));
            return view('tampil-data-entry', [
                'data' => entry::whereBetween('created_at', [$tgl[0], $tgl[1]])->get(),
                'type' => type::get(),
                'variasi' => variasi::get(),
                'petani' => petani::get(),
                'pabrik' => pabrik::select('id_pabrik', 'nama_pabrik')->get(),
                'title' => 'Entry'
            ]);
        }
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
        $map = $this->mappingData($req);
        return entry::insert([
            'periode' => $req->periode,
            'masa_giling' => $req->masa,
            'id_pabrik' => explode(' | ', $req->pabrik)[0],
            'pabrik' => explode(' | ', $req->pabrik)[1],
            'reg' => explode(' | ', $req->reg)[0],
            'petani' => $req->petani,
            'nospta' => $req->nospta,
            'nopol' => $req->nopol,
            'bobot' => $req->bobot,
            'variasi' => $req->variasi,
            'variasi_' => $map['variasi'],
            'type' => $req->type,
            'type_' => $map['type'],
            'keterangan' => $req->keterangan,
            'harga_beli' => str_replace('.', '', explode(' ', $req->harga_beli)[1]),
            'hpp' => str_replace('.', '', explode(' ', $req->hpp)[1]),
            'sisa' => str_replace('.', '', explode(' ', $req->sisa)[1]),
        ])
            ? redirect()->back()->with('sukses', 'data berhasil ditambahkan')
            : redirect()->back()->with('error', 'data gagal ditambahkan');
    }

    public function mappingData($req)
    {
        $variasi = variasi::select('variasi')->where('id_variasi', $req->variasi)->first();
        $type = type::select('type')->where('id_type', $req->type)->first();
        return ['variasi' => $variasi['variasi'], 'type' => $type['type']];
    }

    public function updateMethod(Request $req, $id)
    {
        $map = $this->mappingData($req);
        return entry::where('id_entry', $id)->update([
            'periode' => $req->periode,
            'masa_giling' => $req->masa,
            'id_pabrik' => explode(' | ', $req->pabrik)[0],
            'pabrik' => explode(' | ', $req->pabrik)[1],
            'reg' => explode(' | ', $req->reg)[0],
            'petani' => $req->petani,
            'nospta' => $req->nospta,
            'nopol' => $req->nopol,
            'bobot' => $req->bobot,
            'variasi' => $req->variasi,
            'variasi_' => $map['variasi'],
            'type' => $req->type,
            'type_' => $map['type'],
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

    public function searchMethod($s = null)
    {
        return response()->json([
            'data' => entry::whereDate('created_at', now())
                ->where('periode', 'LIKE', '%' . $s . '%')
                ->orWhere('masa_giling', 'LIKE', '%' . $s . '%')
                ->orWhere('reg', 'LIKE', '%' . $s . '%')
                ->orWhere('nospta', 'LIKE', '%' . $s . '%')
                ->orWhere('nopol', 'LIKE', '%' . $s . '%')
                ->orWhere('variasi_', 'LIKE', '%' . $s . '%')
                ->orWhere('type_', 'LIKE', '%' . $s . '%')
                ->orWhere('pabrik', 'LIKE', '%' . $s . '%')
                ->get()
        ]);
    }
}
