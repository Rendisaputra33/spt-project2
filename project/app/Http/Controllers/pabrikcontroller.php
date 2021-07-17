<?php

namespace App\Http\Controllers;

use App\Models\pabrik;
use Illuminate\Http\Request;

class pabrikcontroller extends Controller
{
    // index method for display data pabrik
    public function indexMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => pabrik::get(),
            'title' => 'Pabrik'
        ]);
    }
    // add method for add data pabrik
    public function addMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => pabrik::get(),
            'title' => 'Pabrik'
        ]);
    }
    // update method for update data pabrik
    public function updateMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => pabrik::get(),
            'title' => 'Pabrik'
        ]);
    }
    // delete method for delete data pabrik
    public function deleteMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => pabrik::get(),
            'title' => 'Pabrik'
        ]);
    }
    // get data update for update data pabrik
    public function getupMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => pabrik::get(),
            'title' => 'Pabrik'
        ]);
    }
}
