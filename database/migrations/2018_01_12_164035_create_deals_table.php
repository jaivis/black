<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_DEALS', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('ORDER')->nullable();
            $table->boolean('OUTLAY')->nullable(FALSE);
            $table->string('NAME', 200)->nullable(FALSE)->comment('Skaidras naudas saņēmējs/iesniedzējs');
            $table->float('AMOUNT', 9, 2);
            $table->integer('OBJECTS_ID')->nullable(FALSE)->unsigned()->comment('Objekts');
            $table->integer('ELEMENTS_ID')->nullable(FALSE)->unsigned()->comment('Elements');
            $table->integer('TYPES_ID')->nullable(FALSE)->unsigned()->comment('Veids');
            $table->string('PERFORMER', 50)->nullable(FALSE)->comment('Izpildītājs B1/B2/AU1/AU2...');
            $table->integer('SECTIONS_ID')->nullable(FALSE)->unsigned()->comment('Iecirknis');
            $table->integer('SYSTEMS_ID')->nullable(FALSE)->unsigned()->comment('Sistēma');
            $table->text('NOTES')->nullable()->comment('Piezīmes');
            $table->integer('USERS_ID')->nullable()->unsigned()->comment('Lietotājs');
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
        Schema::dropIfExists('_DEALS');
    }
}
