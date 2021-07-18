<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class redirectcontroller extends Controller
{
    public function indexMethod()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function dashMethod()
    {
        return view('dashboard', [
            'title' => 'Dashborad'
        ]);
    }
}
