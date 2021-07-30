<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class typeseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type')->insert([
            [
                'type' => 'TS',
            ],
            [
                'type' => 'TB',
            ],
            [
                'type' => 'BK',
            ],
            [
                'type' => 'AM',
            ],
        ]);
    }
}
