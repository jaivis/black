<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_SECTIONS', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('OBJECTS_ID')->unsigned();
            $table->string('NR', 20)->nullable(FALSE)->comment('Iecirkņa numurs');
            $table->string('NAME', 255)->nullable(FALSE)->comment('Iecirkņa nosaukums');
            $table->integer('PARENT_ID')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('OBJECTS_ID')
                ->references('ID')->on('_OBJECTS')
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
        Schema::dropIfExists('_SECTIONS');
    }
}
