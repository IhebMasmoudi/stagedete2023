<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubFamilysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_families', function (Blueprint $table) {
            $table->increments('SubFamilyCode');
            $table->string('SubFamily');
            $table->integer('FamilyCode')->unsigned();
            $table->foreign('FamilyCode')->references('FamilyCode')->on('locality_families');
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
        Schema::dropIfExists('sub_families');
    }
}
