<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\LineString;
use Phaza\LaravelPostgis\Geometries\Point;
class Linea extends Model
{
    use PostgisTrait;
    /* protected $fillable = [
         'name',
         'address'
     ];*/
     protected $fillable = [
         'user_id',
         'titulo',
         'foto',
         'estilo',
         'comentario',
         'categoria'
     ];
    /* protected $postgisFields = [
         'location',
         'location2',
         'location3',
         'polygon',
         'polygon2'
     ];*/
     protected $postgisFields = [
         'location'
     ];
    /* protected $postgisTypes = [
         'location' => [
             'geomtype' => 'geography',
             'srid' => 4326
         ],
         'location2' => [
             'geomtype' => 'geography',
             'srid' => 4326
         ],
         'location3' => [
             'geomtype' => 'geometry',
             'srid' => 4326
         ],
         'polygon' => [
             'geomtype' => 'geography',
             'srid' => 4326
         ],
         'polygon2' => [
             'geomtype' => 'geometry',
             'srid' => 4326
         ]
     ];*/
     protected $postgisTypes = [
         'location' => [
             'geomtype' => 'geometry',
             //'srid' => 4326
             'srid' => 3857
         ]
     ];
}
