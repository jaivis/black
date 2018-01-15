<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Table
        $table = "_TYPES";

        //  Truncate
        DB::table($table)->delete();
        DB::statement("ALTER TABLE `{$table}` AUTO_INCREMENT = 1;");

        //
        for ($i = 1; $i <= 100; $i++) {
            //
            $c = str_pad($i, 2, '0', STR_PAD_LEFT);

            DB::table($table)->insert([
                'NR' => "{$c}-00000",
                'NAME' => "TYPE_NAME_{$i}",
                'ELEMENTS_ID' => rand(1, 100),
            ]);

        }
    }
}
