<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pembayaran extends Model
{
    protected $table = 'pembayaran';

    public function getPembayaran()
    {
        return DB::select('SELECT invoice, SUM(total) as totals, created_at as creates FROM pembayaran GROUP BY invoice, created_at');
    }
}
