<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_TYPES', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('ELEMENTS_ID')->unsigned();
            $table->string('NR', 20)->unique()->nullable(FALSE)->comment('Veida numurs');
            $table->string('NAME', 255)->nullable(FALSE)->comment('Veida nosaukums');
//            $table->integer('PARENT_ID')->nullable()->unsigned();
            $table->timestamps();

//            $table->foreign('ELEMENTS_ID')
//                ->references('ID')->on('_ELEMENTS')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_TYPES');
    }
}
