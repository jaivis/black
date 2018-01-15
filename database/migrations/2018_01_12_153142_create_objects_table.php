<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_OBJECTS', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('NR', 20)->unique()->nullable(FALSE)->comment('Objekta numurs');
            $table->string('NAME', 255)->nullable(FALSE)->comment('Objekta nosaukums');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_OBJECTS');
    }
}
