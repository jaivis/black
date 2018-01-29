<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Table
        $table = "_ELEMENTS";

        //  Truncate
        DB::table($table)->truncate();

        return;

        //
        for ($i = 1; $i <= 100; $i++) {
            //

            DB::table($table)->insert([
                'NR' => "NR_ELEM_{$i}",
                'NAME' => "ELEMENT_NAME_{$i}"
            ]);

        }
    }
}
