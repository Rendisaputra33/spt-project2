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
}
