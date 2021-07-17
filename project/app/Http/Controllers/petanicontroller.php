<?php

namespace App\Http\Controllers;

use App\Models\petani;
use Illuminate\Http\Request;

class petanicontroller extends Controller
{
    // index method for display data petani
    public function indexMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => petani::get(),
            'title' => 'Pabrik'
        ]);
    }
    // add method for add data petani
    public function addMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => petani::get(),
            'title' => 'Pabrik'
        ]);
    }
    // update method for update data petani
    public function updateMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => petani::get(),
            'title' => 'Pabrik'
        ]);
    }
    // delete method for delete data petani
    public function deleteMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => petani::get(),
            'title' => 'Pabrik'
        ]);
    }
    // get data update for update data petani
    public function getupMethod()
    {
        return view('tampil-data-pabrik', [
            'data' => petani::get(),
            'title' => 'Pabrik'
        ]);
    }
}
