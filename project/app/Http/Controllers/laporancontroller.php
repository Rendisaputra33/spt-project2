<?php

namespace App\Http\Controllers;

use App\Models\entry;
use App\Models\pabrik;
use App\Models\type;
use Illuminate\Http\Request;

class laporancontroller extends Controller
{
    public function indexMethod()
    {
        return view('tampil-data-laporan', [
            'data' => entry::whereMonth('created_at', date('m'))->get(),
            'pabrik' => pabrik::get(),
            'type' => type::get(),
            'title' => 'Laporan'
        ]);
    }

    public function addMethod(Request $req)
    {
        $kondisi1 = $req->tanggalaw != '' && $req->tanggalak != '' && $req->periode == '' && $req->type == '' && $req->pabrik == '';
        $kondisi2 = $req->tanggalaw == '' && $req->tanggalak == '' && $req->periode != '' && $req->type == '' && $req->pabrik == '';
        $kondisi3 = $req->tanggalaw == '' && $req->tanggalak == '' && $req->periode == '' && $req->type != '' && $req->pabrik == '';
        $kondisi4 = $req->tanggalaw == '' && $req->tanggalak == '' && $req->periode == '' && $req->type == '' && $req->pabrik != '';
        $kondisi5 = $req->tanggalaw != '' && $req->tanggalak != '' && $req->periode != '' && $req->type != '' && $req->pabrik != '';

        if ($kondisi1) {
            return view('tampil-data-laporan', [
                'data' => entry::whereBetween('created_at', [$req->tanggalaw, $req->tanggalak])->get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
                'filter' => [
                    'type' => 'range',
                    'data' => "$req->tanggalaw&$req->tanggalak"
                ],
                'title' => 'Laporan'
            ]);
        }

        if ($kondisi2) {
            return view('tampil-data-laporan', [
                'data' => entry::where('periode', $req->periode)->get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
                'filter' => [
                    'type' => 'periode',
                    'data' => "$req->periode"
                ],
                'title' => 'Laporan'
            ]);
        }
        if ($kondisi3) {
            return view('tampil-data-laporan', [
                'data' => entry::where('type_', $req->type)->get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
                'filter' => [
                    'type' => 'type',
                    'data' => "$req->type"
                ],
                'title' => 'Laporan'
            ]);
        }
        if ($kondisi4) {
            return view('tampil-data-laporan', [
                'data' => entry::where('id_pabrik', $req->pabrik)->get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
                'filter' => [
                    'type' => 'pabrik',
                    'data' => "$req->pabrik"
                ],
                'title' => 'Laporan'
            ]);
        }
        if ($kondisi5) {
            return view('tampil-data-laporan', [
                'data' => entry::where('id_pabrik', $req->pabrik)
                    ->where('periode', $req->periode)
                    ->where('type_', $req->type)
                    ->whereBetween('created_at', [$req->tanggalaw, $req->tanggalak])
                    ->get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
                'filter' => [
                    'type' => 'all',
                    'data' => "$req->tanggalaw&$req->tanggalak&$req->periode&$req->pabrik&$req->type"
                ],
                'title' => 'Laporan'
            ]);
        }

        return redirect()->back();
    }

    public function filterMethod($f)
    {
        $param = explode('=', $f);
        if ($param[0] == 'range') {
            $parameter = explode('&', $param[1]);
            return view('cetak-laporan', [
                'data' => entry::whereBetween('created_at', [$parameter[0], $parameter[1]])->get(),
                'title' => 'Cetak Laporan'
            ]);
        } elseif ($param[0] == 'periode') {
            return view('cetak-laporan', [
                'data' => entry::where('periode', $param[1])->get(),
                'title' => 'Cetak Laporan'
            ]);
        } elseif ($param[0] == 'pabrik') {
            return view('cetak-laporan', [
                'data' => entry::where('id_pabrik', $param[1])->get(),
                'title' => 'Cetak Laporan'
            ]);
        } elseif ($param[0] == 'type') {
            return view('cetak-laporan', [
                'data' => entry::where('type_', $param[1])->get(),
                'title' => 'Cetak Laporan'
            ]);
        } elseif ($param[0] == 'all') {
            $parameter = explode('&', $param[1]);
            return view('cetak-laporan', [
                'data' => entry::whereBetween('created_at', [$parameter[0], $parameter[1]])
                    ->where('periode', $parameter[2])
                    ->where('id_pabrik', $parameter[3])
                    ->where('type_', $parameter[4])
                    ->get(),
                'title' => 'Cetak Laporan'
            ]);
        } elseif ($param[0] == 'month') {
            return view('cetak-laporan', [
                'data' => entry::whereMonth('created_at', date('m'))->get(),
                'title' => 'Cetak Laporan'
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function cetakMethod($parameter)
    {
        return view('cetak-laporan', [
            'data' => entry::whereIn('id_entry', $parameter)->get()
        ]);
    }
}
