<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class entry extends Model
{
    use HasFactory;
    protected $table = 'entry';

    public static function search($param)
    {
        $now = date('Y-m-d');
        return DB::select("SELECT entry.id_entry as id_entry, id_pembayaran, pembayaran.id_entry as entry_id, harga_beli, bobot, type, type_, variasi, variasi_, reg, nospta, nopol, periode, keterangan, pabrik, id_pabrik, masa_giling, entry.created_at, entry.updated_at as updated_at FROM entry LEFT JOIN pembayaran ON entry.id_entry = pembayaran.id_entry WHERE(
            entry.created_at LIKE '%$now%' AND periode LIKE '%$param%'
            OR
            entry.created_at LIKE '%$now%' AND pabrik LIKE '%$param%'
            OR
            entry.created_at LIKE '%$now%' AND type_ LIKE '%$param%'
            OR
            entry.created_at LIKE '%$now%' AND variasi_ LIKE '%$param%'
            OR
            entry.created_at LIKE '%$now%' AND nopol LIKE '%$param%'
            OR
            entry.created_at LIKE '%$now%' AND nospta LIKE '%$param%'
            OR
            entry.created_at LIKE '%$now%' AND reg LIKE '%$param%'
            OR
            entry.created_at LIKE '%$now%' AND masa_giling LIKE '%$param%'
        )");
    }

    public static function searchBetwen($tgl1, $tgl2, $param)
    {
        return DB::select("SELECT entry.id_entry as id_entry, id_pembayaran, pembayaran.id_entry as entry_id, harga_beli, bobot, type, type_, variasi, variasi_, reg, nospta, nopol, periode, keterangan, pabrik, id_pabrik, masa_giling, entry.created_at, entry.updated_at as updated_at FROM entry LEFT JOIN pembayaran ON entry.id_entry = pembayaran.id_entry  WHERE(
            entry.created_at BETWEEN '$tgl1' AND '$tgl2' AND periode LIKE '%$param%'
            OR
            entry.created_at BETWEEN '$tgl1' AND '$tgl2' AND pabrik LIKE '%$param%'
            OR
            entry.created_at BETWEEN '$tgl1' AND '$tgl2' AND type_ LIKE '%$param%'
            OR
            entry.created_at BETWEEN '$tgl1' AND '$tgl2' AND variasi_ LIKE '%$param%'
            OR
            entry.created_at BETWEEN '$tgl1' AND '$tgl2' AND nopol LIKE '%$param%'
            OR
            entry.created_at BETWEEN '$tgl1' AND '$tgl2' AND nospta LIKE '%$param%'
            OR
            entry.created_at BETWEEN '$tgl1' AND '$tgl2' AND reg LIKE '%$param%'
            OR
            entry.created_at BETWEEN '$tgl1' AND '$tgl2' AND masa_giling LIKE '%$param%'
        ) ORDER BY id_entry DESC");
    }
}
