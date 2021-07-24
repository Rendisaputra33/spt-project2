<?php

namespace App\Http\Controllers;

use App\Models\entry;
use Illuminate\Http\Request;

class laporancontroller extends Controller
{
    public function indexMethod()
    {
        return view('laporan', [
            'data' => entry::get(),
            'title' => 'Laporan'
        ]);
    }

    public function fetchMethod(Request $req)
    {
        # code...
    }

    public function cetakMethod($parameter)
    {
        return view('laporan', [
            'data' => entry::whereIn('id_entry', $parameter)->get()
        ]);
    }
}
