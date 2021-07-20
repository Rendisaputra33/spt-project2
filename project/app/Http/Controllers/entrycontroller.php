<?php

namespace App\Http\Controllers;

use App\Models\entry;
use Illuminate\Http\Request;

class entrycontroller extends Controller
{
    public function indexMethod()
    {
        return view('tampil-data-entry', [
            'data' => entry::get(),
            'title' => 'Entry'
        ]);
    }

    public function add()
    {
        return 'ok';
    }
}
