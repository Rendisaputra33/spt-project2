<?php

namespace App\Http\Controllers;

use App\Models\entry;
use Illuminate\Http\Request;

class laporancontroller extends Controller
{
    public function indexMethod()
    {
        return view('tampil-data-laporan', [
            'data' => entry::get(),
            'title' => 'Laporan'
        ]);
    }

    public function fetchMethod()
    {
        // switch(request('f')) {
        //     case:
        //         return 
        // }
    }

    public function cetakMethod($parameter)
    {
        return view('cetak-laporan', [
            'data' => entry::whereIn('id_entry', $parameter)->get()
        ]);
    }
}
