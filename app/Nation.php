<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use ElevenLab\GeoLaravel\Eloquent\Model as GeoModel;

class Country extends GeoModel
{
    protected $table = "countries";

    protected $geometries = [
        "polygons" =>   ['national_bounds'],
        "points" => ['capital'],
        "multipolygons" => ['regions_bounds'],
        "multipoints" => ['regions_capitals'],
        "linestrings" => ['highway']
    ];
}