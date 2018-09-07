<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;
class Locations extends Model
{
    use PostgisTrait;
   /* protected $fillable = [
        'name',
        'address'
    ];*/
    protected $fillable = [
        'user_id',
        'titulo',
        'address',
        'foto',
        'estilo'
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
     public function getImagen()
    {
        return "retorno get imagen";
       /* if ($this->photo_extension)
            return asset('images/users/'.$this->id.'.'.$this->photo_extension);
    
        return asset('images/users/default.jpg');*/
    }
    protected $postgisTypes = [
        'location' => [
            'geomtype' => 'geometry',
            //'srid' => 4326
            'srid' => 3857
        ]
    ];
}
