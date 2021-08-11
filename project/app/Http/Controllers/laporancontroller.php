<?php

namespace App\Http\Controllers;

use App\Models\entry;
use App\Models\pabrik;
use App\Models\type;
use Illuminate\Http\Request;
use Illuminate\View\View as ViewView;

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
        $kondisi1 = $req->periode == '' && $req->type == '' && $req->pabrik == '';
        $kondisi2 = $req->periode != '' && $req->type == '' && $req->pabrik == '';
        $kondisi3 = $req->periode == '' && $req->type != '' && $req->pabrik == '';
        $kondisi4 = $req->periode == '' && $req->type == '' && $req->pabrik != '';
        $kondisi5 = $req->periode != '' && $req->type != '' && $req->pabrik != '';

        if ($req->masa !== null) {
            if ($kondisi1) {
                return view('tampil-data-laporan', [
                    'data' => entry::whereBetween('created_at', [$req->tanggalaw, $req->tanggalak])
                        ->where('masa_giling', $req->masa)
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'range',
                        'data' => "$req->tanggalaw&$req->tanggalak"
                    ],
                    'title' => 'Laporan',

                ]);
            }

            if ($kondisi2) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('periode', $req->periode)
                        ->where('masa_giling', $req->masa)
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'periode',
                        'data' => "$req->periode"
                    ],
                    'title' => 'Laporan',
                    'periode' => "$req->periode"
                ]);
            }
            if ($kondisi3) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('type_', $req->type)
                        ->where('masa_giling', $req->masa)
                        ->get(),
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
                    'data' => entry::where('id_pabrik', $req->pabrik)
                        ->where('masa_giling', $req->masa)
                        ->get(),
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
        } else {
            if ($kondisi1) {
                return view('tampil-data-laporan', [
                    'data' => entry::whereBetween('created_at', [$req->tanggalaw, $req->tanggalak])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'range',
                        'data' => "$req->tanggalaw&$req->tanggalak"
                    ],
                    'title' => 'Laporan',
                ]);
            }

            if ($kondisi2) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('periode', $req->periode)
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'periode',
                        'data' => "$req->periode"
                    ],
                    'title' => 'Laporan',
                    'periode' => "$req->periode"
                ]);
            }
            if ($kondisi3) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('type_', $req->type)
                        ->get(),
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
                    'data' => entry::where('id_pabrik', $req->pabrik)
                        ->get(),
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
    }

    public function filterMethod($f)
    {
        $param = explode('=', $f);
        if ($param[0] == 'range') {
            $parameter = explode('&', $param[1]);
            return view('cetak-laporan', [
                'data' => entry::whereBetween('created_at', [$parameter[0], $parameter[1]])->get(),
                'title' => 'Cetak Laporan',
                'tanggal' => [$parameter[0], $parameter[1]],
            ]);
        } elseif ($param[0] == 'periode') {
            return view('cetak-laporan', [
                'data' => entry::where('periode', $param[1])->get(),
                'title' => 'Cetak Laporan',
                'periode' => $param[1],
            ]);
        } elseif ($param[0] == 'pabrik') {
            $query = entry::where('id_pabrik', $param[1]);
            return view('cetak-laporan', [
                'data' => $query->get(),
                'title' => 'Cetak Laporan',
                'pabrik' => $query->first()['pabrik'],
            ]);
        } elseif ($param[0] == 'type') {
            return view('cetak-laporan', [
                'data' => entry::where('type_', $param[1])->get(),
                'title' => 'Cetak Laporan',
                'type' => "$param[1]"
            ]);
        } elseif ($param[0] == 'all') {
            $parameter = explode('&', $param[1]);
            return view('cetak-laporan', [
                'data' => entry::whereBetween('created_at', [$parameter[0], $parameter[1]])
                    ->where('periode', $parameter[2])
                    ->where('id_pabrik', $parameter[3])
                    ->where('type_', $parameter[4])
                    ->get(),
                'title' => 'Cetak Laporan',
                'tanggal' => [$parameter[0], $parameter[1]],
                'periode' => $parameter[2],
                'pabrik' => pabrik::select('nama_pabrik')->where('id_pabrik', $parameter[3])->first()['nama_pabrik'],
                'type' => $parameter[4]
            ]);
        } elseif ($f == 'month') {
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
