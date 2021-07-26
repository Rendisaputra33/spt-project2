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
            $data = explode('/', request('f'));
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
                'data' => entry::get(),
                'pabrik' => pabrik::get(),
                'type' => type::get(),
                'title' => 'Laporan'
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
