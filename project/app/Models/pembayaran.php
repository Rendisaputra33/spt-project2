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

    public function filterPembayaran(array $tgl)
    {
        return DB::select("SELECT invoice, SUM(total) as totals, pembayaran.created_at as creates, mstr_pengirim.nama_pengirim as pengirim FROM pembayaran JOIN entry ON pembayaran.id_entry = entry.id_entry JOIN mstr_pengirim ON entry.keterangan = mstr_pengirim.id_pengirim WHERE pembayaran.created_at BETWEEN '{$tgl[0]}' AND '{$tgl[1]}' GROUP BY invoice, pembayaran.created_at, keterangan, mstr_pengirim.nama_pengirim");
    }

    public function searchPembayaran(string $query)
    {
        return DB::select("SELECT invoice, SUM(total) as totals, pembayaran.created_at as creates, mstr_pengirim.nama_pengirim as pengirim FROM pembayaran JOIN entry ON pembayaran.id_entry = entry.id_entry JOIN mstr_pengirim ON entry.keterangan = mstr_pengirim.id_pengirim WHERE 
            invoice LIKE '%{$query}%' OR
            mstr_pengirim.nama_pengirim LIKE '%{$query}%'
         GROUP BY invoice, pembayaran.created_at, keterangan, mstr_pengirim.nama_pengirim");
    }
}
