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
        return DB::select('SELECT invoice, SUM(total) as totals, pembayaran.created_at as creates, mstr_pengirim.nama_pengirim as pengirim FROM pembayaran JOIN entry ON pembayaran.id_entry = entry.id_entry JOIN mstr_pengirim ON entry.keterangan = mstr_pengirim.id_pengirim GROUP BY invoice, pembayaran.created_at, keterangan, mstr_pengirim.nama_pengirim');
    }
}
