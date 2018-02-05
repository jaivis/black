<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Table
        $table = "users";

        //  Truncate
        DB::table($table)->truncate();

        //
        DB::table($table)->insert([
            'name' => 'Aivis Janšauskis',
            'email' => 'aivis@studija.it',
            'password' => bcrypt('Aa12#$'),
        ]);
        //
        DB::table($table)->insert([
            'name' => 'Arvīds Eglītis',
            'email' => 'arvids@bierens.lv',
            'password' => bcrypt('Aa12#$'),
        ]);
    }
}
