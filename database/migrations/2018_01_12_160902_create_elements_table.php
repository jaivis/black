<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_ELEMENTS', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('NR', 20)->unique()->nullable(FALSE)->comment('Elementa numurs');
            $table->string('NAME', 255)->nullable(FALSE)->comment('Elementa nosaukums');
//            $table->integer('PARENT_ID')->nullable()->unsigned();
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
        Schema::dropIfExists('_ELEMENTS');
    }
}
