<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_CLASSIFIERS', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('NAME', 255)->nullable(FALSE)->comment('Klasifikatora nosaukums');
            $table->string('GROUP', 25)->nullable(FALSE)->comment('Klasifikatora grupa (elements,types,sections,systems...)');
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
        Schema::dropIfExists('_CLASSIFIERS');
    }
}
