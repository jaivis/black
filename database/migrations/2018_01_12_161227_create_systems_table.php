<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_SYSTEMS', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('TYPES_ID')->unsigned();
            $table->string('NR', 20)->nullable(FALSE)->comment('Sistēmas numurs');
            $table->string('NAME', 255)->nullable(FALSE)->comment('Sistēmas nosaukums');
            $table->integer('PARENT_ID')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('TYPES_ID')
                ->references('ID')->on('_TYPES')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_SYSTEMS');
    }
}
