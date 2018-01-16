<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassifiersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Māja',
            'GROUP' => 'sections'
        ]);
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Pirts',
            'GROUP' => 'sections'
        ]);
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Garāža',
            'GROUP' => 'sections'
        ]);
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Angārs',
            'GROUP' => 'sections'
        ]);
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Veids 1',
            'GROUP' => 'types'
        ]);
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Veids 2',
            'GROUP' => 'types'
        ]);
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Sistēma 1',
            'GROUP' => 'systems'
        ]);
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Sistēma 2',
            'GROUP' => 'systems'
        ]);
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Sistēma 3',
            'GROUP' => 'systems'
        ]);
        DB::table('_CLASSIFIERS')->insert([
            'NAME' => 'Sistēma 4',
            'GROUP' => 'systems'
        ]);
    }
}
