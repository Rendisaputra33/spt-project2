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
        $query = request('f');
        if (isset($query)) {
            $data = explode('|', request('f'));
            if (count($data) === 2) {
                return view('tampil-data-laporan', [
                    'data' => entry::whereBetween('created_at', [$data[0], $data[1]])->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'title' => 'Laporan'
                ]);
            } else {
                return view('tampil-data-laporan', [
                    'data' => entry::where('id_pabrik', request('f'))
                        ->orWhere('periode', $query)
                        ->orWhere('type', $query)
                        ->get(),
                    'pabrik' => pabrik::get(),
                    'type' => type::get(),
                    'title' => 'Laporan'
                ]);
            }
        } else {
            return view('tampil-data-laporan', [
                'data' => entry::whereMonth('created_at', date('m'))->get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
                'title' => 'Laporan'
            ]);
        }
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
                'title' => 'Laporan'
            ]);
        }

        if ($kondisi2) {
            return view('tampil-data-laporan', [
                'data' => entry::where('periode', $req->periode)->get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
                'title' => 'Laporan'
            ]);
        }
        if ($kondisi3) {
            return view('tampil-data-laporan', [
                'data' => entry::where('type_', $req->type)->get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
                'title' => 'Laporan'
            ]);
        }
        if ($kondisi4) {
            return view('tampil-data-laporan', [
                'data' => entry::where('id_pabrik', $req->pabrik)->get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
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
                'title' => 'Laporan'
            ]);
        }

        return  redirect()->back();
    }

    public function filterMethod($f)
    {
        $query = $f;
        $data = explode('|', $f);
        if (count($data) === 2) {
            return view('cetak-laporan', [
                'data' => entry::whereBetween('created_at', [$data[0], $data[1]])->get(),
                'title' => 'Cetak Laporan'
            ]);
        } else {
            return view('cetak-laporan', [
                'data' => entry::where('id_pabrik', request('f'))
                    ->orWhere('periode', $query)
                    ->orWhere('type', $query)
                    ->get(),
                'title' => 'Cetak Laporan'
            ]);
        }
    }

    public function cetakMethod($parameter)
    {
        return view('cetak-laporan', [
            'data' => entry::whereIn('id_entry', $parameter)->get()
        ]);
    }
}
