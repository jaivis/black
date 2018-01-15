<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Table
        $table = "_DEALS";

        //  Truncate
        DB::table($table)->delete();
        DB::statement("ALTER TABLE `{$table}` AUTO_INCREMENT = 1;");

        $names = [
            'Jānis',
            'Pēteris',
            'Valdis',
            'Juris',
            'Egīls',
            'Edgars',
            'Edmunds',
            'Osvalds',
            'Ojārs',
            'Tālis',
            'Toms',
            'Dainis',
            'Einuks',
            'Andis',
            'Viktors',
        ];

        $surnames = [
            'Bērziņš',
            'Celms',
            'Akmens',
            'Skujiņš',
            'Koks',
            'Kalns',
            'Einuks',
            'Priede',
            'Jušķēns',
            'Daugavietis',
            'Bojārs',
            'Līdaka',
            'Asaris',
            'Kleins',
            'Briedis',
        ];

        $performers = [
            'AU',
            'B',
        ];

        //
        for ($i = 1; $i <= 100; $i++) {

            DB::table($table)->insert([
                'OUTLAY' => rand(0, 1),
                'NAME' => $names[rand(0, 14)] . ' ' . $surnames[rand(0, 14)],
                'AMOUNT' => rand(10, 10000) + (rand(0, 10) / 10),
                'OBJECTS_ID' => rand(1, 100),
                'ELEMENTS_ID' => rand(1, 100),
                'TYPES_ID' => rand(1, 38),
                'PERFORMER' => $performers[rand(0, 1)] . rand(0, 20),
                'SECTIONS_ID' => rand(1, 30),
                'SYSTEMS_ID' => rand(1, 40),
            ]);

        }

    }
}
