<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoligonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poligonos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->point('location'); // GEOGRAPHY POINT column with SRID of 4326 (these are the default values).
            $table->point('location2', 'GEOGRAPHY', 4326); // GEOGRAPHY POINT column with SRID of 4326 with optional parameters.
            $table->point('location3', 'GEOMETRY', 27700); // GEOMETRY column with SRID of 27700.
            $table->polygon('polygon'); // GEOGRAPHY POLYGON column with SRID of 4326.
            $table->polygon('polygon2', 'GEOMETRY', 27700); // GEOMETRY POLYGON column with SRID of 27700.
            $table->linestring('lineas', 'GEOMETRY', 3857); // GEOMETRY POLYGON column with SRID of 27700.
           // $table->linestring('line', 'GEOMETRY', 27700); // GEOMETRY POLYGON column with SRID of 27700.
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
        Schema::dropIfExists('poligonos');
    }
}
