<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('airline_id')->unsigned();
            $table->unsignedSmallInteger('number');
            $table->string('uid');
            $table->integer('departure_airport')->unsigned();
            $table->integer('arrival_airport')->unsigned();
            $table->timestamp('departure_time');
            $table->timestamp('arrival_time');
            $table->smallInteger('hours')->unsigned();
            $table->smallInteger('minutes')->unsigned();
            $table->float('price');
            $table->timestamps();
        });

//        "airline": "AC",
//        "number": "301",
//        "departure_airport": "YUL",
//        "departure_time": "07:35",
//        "arrival_airport": "YVR",
//        "arrival_time": "10:05",
//        "price": "273.23"

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
