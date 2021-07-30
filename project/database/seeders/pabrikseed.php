<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pabrikseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mstr_pabrik')->insert([
            [
                'nama_pabrik' => 'Bonagong',
                'kode_pabrik' => 'QWA90PL'
            ],
            [
                'nama_pabrik' => 'Brebes',
                'kode_pabrik' => 'QWA80PL'
            ],
        ]);
    }
}
