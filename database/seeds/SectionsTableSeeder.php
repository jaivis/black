<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Table
        $table = "_SECTIONS";

        //  Truncate
        DB::table($table)->truncate();

        //
        $opt = [
            'Māja',
            'Šķūnis',
            'Terase',
            'Pirts',
            'Garāža',
            'Baseins',
            'Nojume',
            'Saimniecības telpa',
            'Veikals'
        ];

        //
        for ($i = 1; $i <= 30; $i++) {
            //
            $c = str_pad($i, 2, '0', STR_PAD_LEFT);

            DB::table($table)->insert([
                'NR' => "IECIRKNIS_{$c}",
                'NAME' => "IECIRKNIS_{$opt[rand(0,8)]}_{$c}",
                'OBJECTS_ID' => rand(1, 100),
            ]);

        }
    }
}
