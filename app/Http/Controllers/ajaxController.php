<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location as modf;
//use App\modeloPrueba as mod;
//uso el modelo de puntos
use App\Locations as mod;
use App\Geometry_Sample as geometry;
//uso el modelo de lineas
use App\poligono as modP;
use App\Linea as modL;
use App\User as usuarios;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;
use Phaza\LaravelPostgis\Geometries\Point;
use Phaza\LaravelPostgis\Geometries\Polygon;
use Phaza\LaravelPostgis\Geometries\LineString;
use Image as Image;
/*use ElevenLab\GeoLaravel\DataTypes\Point as Point;
use ElevenLab\GeoLaravel\DataTypes\Linestring as Linestring;
use ElevenLab\GeoLaravel\DataTypes\Polygon as Polygon;*/
class ajaxController extends Controller
{

    function postInfoPoint(){
        $url=$_POST['url'];
        //$url_json=json_encode(file_get_contents($url));
        $url_json=file_get_contents($url);//consulta al geoserver
        $data['mensaje'] = $url_json;
        return $data;
    }
    function postSearch(){
        $categoria=$_POST['categoria'];
        $geomsP = mod::where('categoria','=',$categoria)->get();//consulta a la base de datos
        $geomsL = modL::where('categoria','=',$categoria)->get();
        $finalResult = $geomsP->merge($geomsL);
        return $finalResult;
       // $data['mensaje'] = "mensaje del php "."ss";
       // return $data;
    }
    function postMyData(){
        $userId=$_POST['user_id'];
        $geomsP = mod::where('user_id','=',$userId)->get();//consulta a la base de datos
        $geomsL = modL::where('user_id','=',$userId)->get();
        $finalResult = $geomsP->merge($geomsL);
        //$data['mensaje'] = $geoms;
       // return View::make('home')->with('ss', 'mmmmmm');
       // return view('home', ['mensajito' => 'meeeennnn']);
       // return Redirect::route('home', ['name' => 'sananana']);
       // return $geomsP;
        return $finalResult;
    }
    function postDelete(){
        $idGeom=$_POST['idGeom'];
        $typeGeom=$_POST['TypeGeom'];
        if ($typeGeom=="Point"){//selecciono la tabla
            $geom = mod::find($idGeom); //busca en la pk
        }else{
            $geom = modL::find($idGeom); 
        }
        $geom->delete();
        $data['mensaje'] = "mensaje del php ".$idGeom." ".$typeGeom;
        return $data;
    }
    function postEdit(){


        $idGeom=$_POST['idGeom'];
        $typeGeom=$_POST['TypeGeom'];
        if ($typeGeom=="Point"){//selecciono la tabla
            $geom = mod::find($idGeom); //busca en la pk
        }else{
            $geom = modL::find($idGeom); 
        }
        
        if(!is_null($geom)) {
            $geom->titulo = $_POST['titulo'];
            $geom->comentario=$_POST['descripcion'];
            $geom->foto=$_POST['nombreFoto'];
            $geom->categoria=$_POST['categoria'];
            $geom->foto = $_POST['nombreFoto'];
            $geom->save();
            $men="anduvo";
        }else{
            $men="no se encontro id";
        }
        
        $data['mensaje'] = "mensaje del php ".$idGeom." ".$typeGeom.$men;
        return $data;
    }
    function postLine()
    {
        $colCoords=$_POST['colPuntos'];//coleccion de coordenadas (no presente en una consulta de info)
        $nombreFoto=$_POST['nombreFoto'];
        $puntoX=0;
        $puntoY=0;
        $chunkCoords=array_chunk($colCoords,2);//parto el array original de coordenadas de puntos en pares xy
        foreach ($chunkCoords as $key => $value) {//separo los puntos xy para transforarlos en un array de puntos
            for ($i=0; $i < 1; $i++) { 
                $puntoY=$chunkCoords[$key][$i];
                $puntoX=$chunkCoords[$key][$i+1]; 
            }
            $arrayPuntos[$key]=new Point($puntoX,$puntoY);
        }
        $location1=new modL();
        $location1->user_id = $_POST['user_id'];        
        $location1->titulo = $_POST['titulo'];
        $location1->comentario = $_POST['descripcion'];
        $location1->categoria = $_POST['categoria'];
        $location1->location = new LineString($arrayPuntos);
        $location1->foto = $nombreFoto;
        $location1->photo_extension = "estension";
        $location1->estilo ='estilo';
        $location1->save();
    }

    function postPoint()
    {
        $x=$_POST['x'];
        $y=$_POST['y'];
        $nombreFoto=$_POST['nombreFoto'];
        $location1=new mod();
        $location1->user_id = $_POST['user_id'];
        $location1->titulo = $_POST['titulo'];
        $location1->comentario = $_POST['descripcion'];
        $location1->categoria = $_POST['categoria'];
        $location1->address = '1600 Amphitheatre Pkwy Mountain View, CA 94043';
        $location1->location = new Point($y, $x);
        $location1->photo_extension = "estension";
        $location1->foto = $nombreFoto;
        $location1->estilo ='estilo';
        $location1->save();
    }

    public function updatePhoto(Request $request)
    {
        
        $this->validate($request, [
            'photo' => 'required|image'
        ]);
        $nombreFoto=$request->nombreFoto;
        $file = $request->file('photo');
        $extension = $file->getClientOriginalExtension();
       // $fileName = auth()->id() . '.' . $extension;
        //$fileName = $nombreFoto . '.' . $extension;
        $fileName = $nombreFoto ;
        $path = public_path('images/users/'.$fileName);
        $img = Image::make($file);
        $img->resize(null, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save($path);
        //Image::make($file)->fit(300, 300)->save($path);

        $user = auth()->user();
        $user->photo_extension = $extension;
        $saved = $user->save();

        $data['success'] = $saved;
       // $data['path'] = $user->getAvatarUrl() . '?' . uniqid();
        $data['path'] = asset('images/users/'.$fileName);
        return $data;
    }

    function post(){
      /*  $linestring = new LineString(
        [
       new Point(-6535160.493869053, -4126988.0311732357),
        new Point(-6528586.909436529, -4128363.897682369),
        new Point(-6518497.221702885, -4134478.859945183)
        new Point(0, 0),
        new Point(0, 1),
        new Point(1, 1),
        new Point(1, 0),

        ]

        );*/
        $linestring = new LineString(
    [
        new Point(0, 0),
        new Point(0, 1),
        new Point(1, 1),
        new Point(1, 0),
        new Point(0, 0)
    ]
);
         $linestring2 = 
    [
       /* new Point(-6535160, -4126988),
        new Point(-6528586, -4128363),
        new Point(-6518497, -4134478)*/

         new Point(-4126988, -6535160),
        new Point(-4128363, -6528586),
        new Point(-4134478, -6518497)
      /* new Point(35.52675,-139.55723),
        new Point(35.52675,-139.57574 ),
        new Point(35.50841,-139.55723 )*/
    ];
       /* $polygon = new Polygon(
    [
        new Point(35.52675,-139.55723),
        new Point(35.52675,-139.57574 ),
        new Point(35.50841,-139.55723 )

    ]
);*/
      /*  $punto1=new Point(0, 0);
        $punto2=new Point(0, 1);
        $punto3=new Point(1, 1);
        $punto4=new Point(1, 0);*/

        $geom=$_POST['geom'];
        $arrayPuntos=Array();
        switch ($geom) {
            case "Point":
                $x=$_POST['x'];
                $y=$_POST['y'];
                $location1=new mod();
                $location1->user_id = $_POST['user_id'];
                $location1->titulo = $_POST['titulo'];
                $location1->comentario = $_POST['descripcion'];
                $location1->categoria = $_POST['categoria'];
                $location1->address = '1600 Amphitheatre Pkwy Mountain View, CA 94043';
                $location1->location = new Point($y, $x);
                $location1->foto = 'foto';
                $location1->estilo ='estilo';
                $location1->save();
            break;
            case "LineString":
                $colCoords=$_POST['colPuntos'];//coleccion de coordenadas
                $puntoX=0;
                $puntoY=0;
                $contador=0;
                $cpar=0;
                $cimpar=0;
                $chunkCoords=array_chunk($colCoords,2);//parto el array original de coordenadas de puntos en pares xy
           
                foreach ($chunkCoords as $key => $value) {//separo los puntos xy para transforarlos en un array de puntos
                    for ($i=0; $i < 1; $i++) { 
                        $puntoY=$chunkCoords[$key][$i];
                        $puntoX=$chunkCoords[$key][$i+1]; 
                    }
                    $arrayPuntos[$key]=new Point($puntoX,$puntoY);
                }
                $x=-6546626.04811183;
                $y=-4124083.4240983995;
                $location1=new modL();
                $location1->user_id = $_POST['user_id'];
                $location1->titulo = $_POST['titulo'];
                $location1->comentario = $_POST['descripcion'];
                $location1->categoria = $_POST['categoria'];
                $location1->location = new LineString($arrayPuntos);
               // $location1->location = new LineString($punto1,$punto2,$punto3,$punto4);
               // $location1->location2 = new Point($y, $x);
                $location1->foto = 'foto';
                $location1->estilo ='estilo';
                $location1->save();
                return "hice chunk ".json_encode($chunkCoords[1][1])." par: ".$cpar." impar : ".$cimpar. " un ejemplo ".json_encode($arrayPuntos);

            break;
            case "Polygon":

/*$geometryData = new Geometry_Sample();
$geometryData->name = 'hogehoge';
$geometryData->geom1 = new Point(139.55723, 35.52675);
$polygon = new Polygon(
    [
        new Point(139.55723, 35.52675),
        new Point(139.57574, 35.52675),
        new Point(139.55723, 35.50841)
    ]
);
$geometryData->geom2 = $polygon;*/
//$geometryData->save();



           $location1 = new modP();
$location1->name = $_POST['titulo'];
$location1->address = "santi";
$location1->location = new Point(37.422009, -122.084047);
$location1->location2 = new Point(37.422009, -122.084047);
$location1->location3 = new Point(37.422009, -122.084047);
$location1->polygon = new Polygon([$linestring]);
$location1->polygon2 = new Polygon([$linestring]);
$location1->lineas = new LineString($linestring2);

$location1->save();
//$location2 = Location::first();
       // $location2->location instanceof Point;
                return "hice poli";
            break;
        } //fin switch
        
      /*  $linestring = new LineString(
            [
                new Point(0, 0),
                new Point(0, 1),
                new Point(1, 1),
                new Point(1, 0),
                new Point(0, 0)
            ]
        );
        $location1=new mod();
        $location1->name = 'Googleplex';
        $location1->address = '1600 Amphitheatre Pkwy Mountain View, CA 94043';
        $location1->location = new Point(37.422009, -122.084047);
        $location1->location2 = new Point(37.422009, -122.084047);
        $location1->location3 = new Point(37.422009, -122.084047);
        $location1->polygon = new Polygon([$linestring]);
        $location1->polygon2 = new Polygon([$linestring]);
        $location1->save();*/
//$location1 = new Location();
       // $loca=loc;
        //loc->name = 'Googleplex';
       // $location1 = new Location();
       /* $location1->name = 'Googleplex';
        $location1->address = '1600 Amphitheatre Pkwy Mountain View, CA 94043';
        $location1->location = new Point(37.422009, -122.084047);
        $location1->location2 = new Point(37.422009, -122.084047);
        $location1->location3 = new Point(37.422009, -122.084047);
        $location1->polygon = new Polygon([$linestring]);
        $location1->polygon2 = new Polygon([$linestring]);
        $location1->save();
        
        $location2 = Location::first();
        $location2->location instanceof Point;*/

        /*$coordenada=$_POST['coordenada'];
        
      $response = array();
    $response[0] = array(
        'coordenada'=>$coordenada,
        'id' => '1',
        'lat'=>$lat,
        'lon'=>$lon,
        //'user'=> Auth::user(),
        'value2'=> 'value2'
    );
    $mijson=json_encode($response); 
        return $mijson;*/
    return "listo";
    } //fin post
}
