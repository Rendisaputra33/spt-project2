<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mstr_user')->insert([
            [
                'username' => 'Admin',
                'nama' => 'admin',
                'password' => bcrypt('admin'),
                'level' => 2
            ],
            [
                'username' => 'Petugas',
                'nama' => 'petugas',
                'password' => bcrypt('petugas'),
                'level' => 1
            ]
        ]);
    }
}
