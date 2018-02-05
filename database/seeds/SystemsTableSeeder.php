<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Table
        $table = "_SYSTEMS";

        //  Truncate
        //  DB::table($table)->truncate();

        //  Default
        DB::table($table)->insert([
            'NR' => "0",
            'NAME' => "Kopā",
            'TYPES_ID' => 0
        ]);

        /*
        return;

        //
        for ($i = 1; $i <= 100; $i++) {

            DB::table($table)->insert([
                'NR' => "NR_SYS_{$i}",
                'NAME' => "SYSTEM_NAME_{$i}",
                'TYPES_ID' => rand(1, 100)
            ]);

        }
        */
    }
}
