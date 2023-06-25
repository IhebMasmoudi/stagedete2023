<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->increments('CounterReferenceid');
            $table->string('CounterReference');
            $table->integer('LocalCode')->unsigned();
            $table->integer('CounterTypeCode')->unsigned();
            $table->foreign('LocalCode')->references('LocalCode')->on('locations');
            $table->foreign('CounterTypeCode')->references('CounterTypeCode')->on('counter_types');
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
        Schema::dropIfExists('counters');
    }
}
