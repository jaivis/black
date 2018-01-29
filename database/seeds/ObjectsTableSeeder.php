<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        //  Table
        $table = "_OBJECTS";

        //  Truncate
        DB::table($table)->truncate();

        return;

        //
        for ($i = 1; $i <= 100; $i++) {
            //
            $rand = 100 + $i;

            DB::table($table)->insert([
                'NR' => "PF{$rand}",
                'NAME' => "NAME_{$rand}"
            ]);

        }
    }
}
