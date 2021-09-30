<?php

namespace App\Http\Controllers;

use App\Models\entry;
use App\Models\pabrik;
use App\Models\petani;
use App\Models\type;
use App\Models\variasi;
use App\Models\pengirim;
use Illuminate\Http\Request;

class entrycontroller extends Controller
{
    public function indexMethod(Request $req)
    {
        if ($req->query('tgl') !== null) {
            $tgl = explode('|', $req->query('tgl'));
            return view('tampil-data-entry', [
                'data' => entry::whereBetween('created_at', [$tgl[0], $this->tanggal($tgl[1])])->orderBy('id_entry', 'DESC')->get(),
                'type' => type::get(),
                'variasi' => variasi::get(),
                'petani' => petani::get(),
                'pabrik' => pabrik::select('id_pabrik', 'nama_pabrik')->get(),
                'pengirim' => pengirim::get(),
                'tanggal' => $req->query('tgl'),
                'title' => 'Entry'
            ]);
        }
        return view('tampil-data-entry', [
            'data' => entry::whereDate('entry.created_at', now())->orderBy('id_entry', 'DESC')->get(),
            'type' => type::get(),
            'variasi' => variasi::get(),
            'petani' => petani::get(),
            'pengirim' => pengirim::get(),
            'pabrik' => pabrik::select('id_pabrik', 'nama_pabrik')->get(),
            'title' => 'Entry'
        ]);
    }

    private function tanggal($tgl)
    {
        $timefuture = strtotime($tgl) + 86400;
        return date('Y-m-d', $timefuture);
    }

    public function editHpp(Request $req)
    {
        return entry::where('id_entry', $req->id)->update([
            'keterangan' => $req->pengirim,
            'hpp' => $req->hpp
        ]) ? redirect()->back()->with('sukses', 'update hpp berhasil') : redirect()->back()->with('error', 'update hpp gagal');
    }

    public function addMethod(Request $req)
    {
        $map = $this->mappingData($req);
        $data = [
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
            'type_' => $map['type']
        ];
        $req->keterangan !== null ? $data['keterangan'] = $req->keterangan : '';
        $req->hpp !== null ? $data['hpp'] = str_replace('.', '', explode(' ', $req->hpp)[1]) : '';

        return entry::insert($data)
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
            'hpp' => $req->hpp === null ? null : str_replace('.', '', explode(' ', $req->hpp)[1])
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
        $data = entry::where('id_entry', $id)->first();
        return response()->json([
            'data' => $data,
            'reg' => petani::where('id_pabrik', $data->id_pabrik)->get()
        ]);
    }

    public function searchMethod($s)
    {
        $param = explode('&', $s);
        if (count($param) == 2) {
            $tgl = explode('|', $param[1]);
            if ($param[0] == 'tidak-ada') {
                return response()->json([
                    'data' => entry::whereBetween('created_at', [$tgl[0], $this->tanggal($tgl[1])])->get(),
                ]);
            } else {
                return response()->json([
                    'data' => entry::searchBetwen($tgl[0], $this->tanggal($tgl[1]), $param[0])
                ]);
            }
        } else {
            if ($s === 'tidak-ada') {
                return response()->json([
                    'data' => entry::whereDate('created_at', now())->get(),
                ]);
            }
            return response()->json([
                'data' => entry::search($s)
            ]);
        }
    }
}
