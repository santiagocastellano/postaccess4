<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans:400,800' rel='stylesheet' type='text/css'>
 <link rel="stylesheet" href="{{ asset('css/cssol4/ol.css') }}" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">-->
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script type="text/javascript" src="{{URL::asset('js/ol4/ol.js')}}"></script>
    <script src="{{URL::asset('js/script.js')}}"></script>
    <script src="js/script.js"></script>
   
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .aviso{
                
                color: #FFF;
                background: #000;
                position:absolute; /*El div será ubicado con relación a la pantalla*/
                left:0px; /*A la derecha deje un espacio de 0px*/
                right:0px; /*A la izquierda deje un espacio de 0px*/
                bottom:0px; /*Abajo deje un espacio de 0px*/
                height:50px; /*alto del div*/
                z-index:0;
                text-align: center;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Ingresar</a>
                        <a href="{{ route('register') }}">Registro</a>
                    @endauth

                </div>
            @endif
   <div class="aviso">Registrese en el sistema para consultar y editar datos.</div>         
<div class="card" style="width:90%;height:500px; ">
 
<div  style="width:100%;height:500px; " id="map" class="map">  </div>
</div>
            <div class="content">
                

                <main class="py-4" >
                    @yield('content')
                    @yield('view.scripts')
                </main>
            </div>

        </div>

<script > 
     var j = jQuery.noConflict();

    j(document).ready(function(){
        console.log("inicio");
        ///////////////////capas inicio///////////////////////
        var source = new ol.source.Vector({wrapX: false});
        var raster = new ol.layer.Tile({
            source: new ol.source.OSM()
        });

         // source = new ol.source.Vector({wrapX: false});

          vector = new ol.layer.Vector({
            source: source
          });

          mapaLineas=new ol.layer.Tile({
              source: new ol.source.TileWMS({
                url: 'http://localhost:8080/geoserver/bsas/wms?',
                params: {'LAYERS': 'bsas:lineas', 'TILED': true},
                serverType: 'geoserver'
              })
            });
          mapaPuntos=new ol.layer.Tile({
              source: new ol.source.TileWMS({
                url: 'http://localhost:8080/geoserver/bsas/wms?',
                params: {'LAYERS': 'bsas:locations', 'TILED': true},
                serverType: 'geoserver'
              })
            });
          var fondoOSM= new ol.layer.Tile({source: new ol.source.OSM()});
          var layers = [
            fondoOSM,
            vector,
            mapaPuntos,
            mapaLineas,
          ];

////////////////////////////capas fin////////////////////////////////////////
    var mousePositionControl = new ol.control.MousePosition({
        coordinateFormat: ol.coordinate.createStringXY(4),
        projection: 'EPSG:3857',
        className: 'custom-mouse-position',
        target: document.getElementById('mouse-position'),
        undefinedHTML: '&nbsp;'
      });
      map = new ol.Map({
        target: 'map',
        renderer: 'canvas',

        controls: ol.control.defaults({
        attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
        collapsible: false
        })}).extend([mousePositionControl]),
        layers: layers,
        view: new ol.View({
           projection: 'EPSG:3857',
           center: [-6514269, -4123013],
            //center: [-59.3852, -34.5891],
          zoom: 10
           //   rotation: 1
             // center: ol.proj.transform([2.1833, 41.3833], 'EPSG:4326', 'EPSG:3857'),
             // zoom: 6
            })
        }); //fin new olmap

      });
    
</script>
    </body>
</html>
