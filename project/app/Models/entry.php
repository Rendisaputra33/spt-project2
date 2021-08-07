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
        return DB::select("SELECT * FROM entry WHERE(
            created_at LIKE '%$now%' AND periode LIKE '%$param%'
            OR
            created_at LIKE '%$now%' AND pabrik LIKE '%$param%'
            OR
            created_at LIKE '%$now%' AND type_ LIKE '%$param%'
            OR
            created_at LIKE '%$now%' AND variasi_ LIKE '%$param%'
            OR
            created_at LIKE '%$now%' AND nopol LIKE '%$param%'
            OR
            created_at LIKE '%$now%' AND nospta LIKE '%$param%'
            OR
            created_at LIKE '%$now%' AND reg LIKE '%$param%'
            OR
            created_at LIKE '%$now%' AND masa_giling LIKE '%$param%'
        )");
    }
}
