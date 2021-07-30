<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class varseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variasi')->insert([
            [
                'variasi' => 'MA'
            ],
            [
                'variasi' => 'ML'
            ],
        ]);
    }
}
