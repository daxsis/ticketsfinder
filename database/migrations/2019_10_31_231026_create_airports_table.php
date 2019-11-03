<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icao');
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('city');
            $table->string('region');
            $table->string('country_code');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('timezone');
            $table->timestamps();
        });

//        "code": "YVR",
//        "city_code": "YVR",
//        "name": "Vancouver International",
//        "city": "Vancouver",
//        "country_code": "CA",
//        "region_code": "BC",
//        "latitude": 49.194698,
//        "longitude": -123.179192,
//        "timezone": "America/Vancouver"

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}
