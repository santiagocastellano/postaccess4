<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//use ElevenLab\GeoLaravel\Database\Schema\Blueprint;
class CreateNationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nations', function (Blueprint $table) {
            $table->increments('id');
    $table->string('name');
    $table->polygon('national_bounds');
    $table->point('capital');
    $table->multipolygon('regions_bounds');
    $table->multipoint('regions_capitals');
    $table->linestring('highway');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nations');
    }
}
