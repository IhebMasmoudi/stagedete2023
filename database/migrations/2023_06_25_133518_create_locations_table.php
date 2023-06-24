<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('LocalCode');
            $table->string('LocalLabel');
            $table->text('LocalAddress');
            $table->unsignedInteger('DistrictCode'); // Use unsignedInteger for foreign key
            $table->integer('SubFamilyCode')->unsigned();
            $table->foreign('DistrictCode')->references('id')->on('districts');
            $table->foreign('SubFamilyCode')->references('SubFamilyCode')->on('sub_families');
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
        Schema::dropIfExists('locations');
    }
}
