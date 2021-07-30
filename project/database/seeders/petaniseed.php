<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class petaniseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mstr_petani')->insert([
            [
                'nama_petani' => 'Bapak Bambang',
                'reg' => 'PTN90PQ',
                'id_pabrik' => 1
            ],
            [
                'nama_petani' => 'Bapak Wicaksono',
                'reg' => 'PTN91PQ',
                'id_pabrik' => 1
            ],
            [
                'nama_petani' => 'Bapak Prawito',
                'reg' => 'PTN80PQ',
                'id_pabrik' => 2
            ],
        ]);
    }
}
