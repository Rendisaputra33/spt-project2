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

    private function tanggal($tgl)
    {
        $timefuture = strtotime($tgl) + 86400;
        return date('Y-m-d', $timefuture);
    }

    public function addMethod(Request $req)
    {
        $kondisi1 = $req->periode == '' && $req->type == '' && $req->pabrik == '';
        $kondisi2 = $req->periode != '' && $req->type == '' && $req->pabrik == '';
        $kondisi3 = $req->periode == '' && $req->type != '' && $req->pabrik == '';
        $kondisi4 = $req->periode == '' && $req->type == '' && $req->pabrik != '';
        $kondisi5 = $req->periode != '' && $req->type != '' && $req->pabrik != '';
        $kondisi6 = $req->periode != '' && $req->type != '' && $req->pabrik == '';
        $kondisi7 = $req->periode != '' && $req->type == '' && $req->pabrik != '';
        $kondisi8 = $req->periode == '' && $req->type != '' && $req->pabrik != '';

        if ($req->masa !== null) {
            if ($kondisi1) {
                return view('tampil-data-laporan', [
                    'data' => entry::whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->where('masa_giling', $req->masa)
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'range',
                        'data' => "$req->tanggalaw&$req->tanggalak&&$req->masa"
                    ],
                    'title' => 'Laporan',

                ]);
            }

            if ($kondisi2) {
                return view('tampil-data-laporan', [
                    'data' => entry::whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->where('periode', $req->periode)
                        ->where('masa_giling', $req->masa)
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'periode',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->periode&&$req->masa"
                    ],
                    'title' => 'Laporan',
                ]);
            }
            if ($kondisi3) {
                return view('tampil-data-laporan', [
                    'data' => entry::whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->where('type_', $req->type)
                        ->where('masa_giling', $req->masa)
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'type',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->type&&$req->masa"
                    ],
                    'title' => 'Laporan'
                ]);
            }
            if ($kondisi4) {
                return view('tampil-data-laporan', [
                    'data' => entry::whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->where('id_pabrik', $req->pabrik)
                        ->where('masa_giling', $req->masa)
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'pabrik',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->pabrik&&$req->masa"
                    ],
                    'title' => 'Laporan'
                ]);
            }
            if ($kondisi5) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('id_pabrik', $req->pabrik)
                        ->where('periode', $req->periode)
                        ->where('type_', $req->type)
                        ->where('masa_giling', $req->masa)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'all',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->periode&$req->pabrik&$req->type&&$req->masa"
                    ],
                    'title' => 'Laporan'
                ]);
            }

            if ($kondisi6) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('periode', $req->periode)
                        ->where('type_', $req->type)
                        ->where('masa_giling', $req->masa)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'periodeandtype',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->periode&$req->type&&$req->masa"
                    ],
                    'title' => 'Laporan'
                ]);
            }

            if ($kondisi7) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('periode', $req->periode)
                        ->where('id_pabrik', $req->pabrik)
                        ->where('masa_giling', $req->masa)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'periodeandpabrik',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->periode&$req->pabrik&&$req->masa"
                    ],
                    'title' => 'Laporan'
                ]);
            }

            if ($kondisi8) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('type_', $req->type)
                        ->where('id_pabrik', $req->pabrik)
                        ->where('masa_giling', $req->masa)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'typeandpabrik',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->type&$req->pabrik&&$req->masa"
                    ],
                    'title' => 'Laporan'
                ]);
            }

            return redirect()->back();
        } else {
            if ($kondisi1) {
                return view('tampil-data-laporan', [
                    'data' => entry::whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'range',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->tanggalaw&$req->tanggalak"
                    ],
                    'title' => 'Laporan',
                ]);
            }

            if ($kondisi2) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('periode', $req->periode)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'periode',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->periode"
                    ],
                    'title' => 'Laporan',
                    'periode' => "$req->periode"
                ]);
            }
            if ($kondisi3) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('type_', $req->type)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'type',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->type"
                    ],
                    'title' => 'Laporan'
                ]);
            }
            if ($kondisi4) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('id_pabrik', $req->pabrik)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'pabrik',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->pabrik"
                    ],
                    'title' => 'Laporan'
                ]);
            }
            if ($kondisi5) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('id_pabrik', $req->pabrik)
                        ->where('periode', $req->periode)
                        ->where('type_', $req->type)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
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

            if ($kondisi6) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('periode', $req->periode)
                        ->where('type_', $req->type)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'periodeandtype',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->periode&$req->type"
                    ],
                    'title' => 'Laporan'
                ]);
            }

            if ($kondisi7) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('periode', $req->periode)
                        ->where('id_pabrik', $req->pabrik)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'periodeandpabrik',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->periode&$req->pabrik"
                    ],
                    'title' => 'Laporan'
                ]);
            }

            if ($kondisi8) {
                return view('tampil-data-laporan', [
                    'data' => entry::where('type_', $req->type)
                        ->where('id_pabrik', $req->pabrik)
                        ->whereBetween('created_at', [$req->tanggalaw, $this->tanggal($req->tanggalak)])
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'filter' => [
                        'type' => 'typeandpabrik',
                        'data' => "$req->tanggalaw&$req->tanggalak&$req->type&$req->pabrik"
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
        $isMasa = preg_match('/&&/', $f);
        if ($isMasa) {
            if ($param[0] == 'range') {
                $data = explode('&', $param[1]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('masa_giling', array_pop($data))
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                ]);
            }
            if ($param[0] == 'periode') {
                $data = explode('&', $param[1]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('periode', $data[2])
                        ->where('masa_giling', array_pop($data))
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'periode' => $data[2]
                ]);
            }
            if ($param[0] == 'type') {
                $data = explode('&', $param[1]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('type_', $data[3])
                        ->where('masa_giling', array_pop($data))
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                ]);
            }
            if ($param[0] == 'pabrik') {
                $data = explode('&', $param[1]);
                $query = entry::select('pabrik')->where('id_pabrik', $data[3]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('id_pabrik', $data[3])
                        ->where('masa_giling', array_pop($data))
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'pabrik' => $query->first()['pabrik']
                ]);
            }
            if ($param[0] == 'all') {
                $data = explode('&', $param[1]);
                $query = entry::select('pabrik')->where('id_pabrik', $data[3]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('masa_giling', array_pop($data))
                        ->where('periode', $data[2])
                        ->where('id_pabrik', $data[3])
                        ->where('type_', $data[4])
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'periode' => $data[2],
                    'pabrik' => $query->first()['nama_pabrik'],
                    'type' => $data[4]
                ]);
            }
            if ($param[0] == 'periodeandtype') {
                $data = explode('&', $param[1]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('periode', $data[2])
                        ->where('type_', $data[3])
                        ->where('masa_giling', array_pop($data))
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'periode' => $data[2],
                    'type' => $data[3]
                ]);
            }
            if ($param[0] == 'periodeandpabrik') {
                $data = explode('&', $param[1]);
                $query = entry::select('pabrik')->where('id_pabrik', $data[3]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('periode', $data[2])
                        ->where('id_pabrik', $data[3])
                        ->where('masa_giling', array_pop($data))
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'pabrik' => $query->first()['nama_pabrik'],
                    'periode' => $data[2]
                ]);
            }
            if ($param[0] == 'typeandpabrik') {
                $data = explode('&', $param[1]);
                $query = entry::select('pabrik')->where('id_pabrik', $data[3]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('id_pabrik', $data[3])
                        ->where('type_', $data[2])
                        ->where('masa_giling', array_pop($data))
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'pabrik' => $query->first()['nama_pabrik'],
                    'type' => $data[2]
                ]);
            }

            if ($param[0] == 'month') {
                return view('cetak-laporan', [
                    'data' => entry::whereMonth('created_at', date('m'))->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [date('Y-m') . '-01', date('Y-m-d')]
                ]);
            }
        } else {
            if ($param[0] == 'range') {
                $data = explode('&', $param[1]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                ]);
            }
            if ($param[0] == 'periode') {
                $data = explode('&', $param[1]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('periode', $data[2])
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'periode' => $data[2]
                ]);
            }
            if ($param[0] == 'type') {
                $data = explode('&', $param[1]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('type_', $data[3])
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                ]);
            }
            if ($param[0] == 'pabrik') {
                $data = explode('&', $param[1]);
                $query = entry::select('pabrik')->where('id_pabrik', $data[3]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('id_pabrik', $data[3])
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'pabrik' => $query->first()['nama_pabrik']
                ]);
            }
            if ($param[0] == 'all') {
                $data = explode('&', $param[1]);
                $query = entry::select('pabrik')->where('id_pabrik', $data[3]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('periode', $data[2])
                        ->where('id_pabrik', $data[3])
                        ->where('type_', $data[4])
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'periode' => $data[2],
                    'pabrik' => $query->first()['nama_pabrik'],
                    'type' => $data[4]
                ]);
            }
            if ($param[0] == 'periodeandtype') {
                $data = explode('&', $param[1]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('periode', $data[2])
                        ->where('type_', $data[3])
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'periode' => $data[2],
                    'type' => $data[3]
                ]);
            }
            if ($param[0] == 'periodeandpabrik') {
                $data = explode('&', $param[1]);
                $query = entry::select('pabrik')->where('id_pabrik', $data[3]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('periode', $data[2])
                        ->where('id_pabrik', $data[3])
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'pabrik' => $query->first()['nama_pabrik'],
                    'periode' => $data[2]
                ]);
            }
            if ($param[0] == 'typeandpabrik') {
                $data = explode('&', $param[1]);
                $query = entry::select('pabrik')->where('id_pabrik', $data[3]);
                return view('cetak-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $this->tanggal($data[1])])
                        ->where('id_pabrik', $data[3])
                        ->where('type_', $data[2])
                        ->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [$data[0], $data[1]],
                    'pabrik' => $query->first()['nama_pabrik'],
                    'type' => $data[2]
                ]);
            }

            if ($f == 'month') {
                return view('cetak-laporan', [
                    'data' => entry::whereMonth('created_at', date('m'))->get(),
                    'title' => 'Cetak Laporan',
                    'tanggal' => [date('Y-m') . '-01', date('Y-m-d')]
                ]);
            }
        }
    }

    public function cetakMethod($parameter)
    {
        return view('cetak-laporan', [
            'data' => entry::whereIn('id_entry', $parameter)->get()
        ]);
    }
}
