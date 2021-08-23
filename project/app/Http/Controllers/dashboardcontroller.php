<?php

namespace App\Http\Controllers;

use App\Models\entry;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
    public function indexMethod()
    {
        return view('dashboard', [
            'data' => entry::whereDate('created_at', now())->get(),
            'title' => 'Dashboard'
        ]);
    }
}
