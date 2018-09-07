<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geometry_Sample extends Model
{
    use PostgisTrait;
    protected $postgisFields = [
        'geom1',
        'geom2'
    ];

    protected $postgisTypes = [
        'geom1' => [
            'geomtype' => 'geography',
            'srid' => 4326
        ],
        'geom2' => [
            'geomtype' => 'geography',
            'srid' => 4326
        ]
        ];
}
