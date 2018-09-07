@extends('layouts.app')
<style>

    .card{
        width:90%;
        height:400px;
    }
    
  .tituloBusqueda{
    text-align: center;
    background-color: #f1f1f1;
    margin: 20px auto;
  }
  .enviarBusqueda, .centro{
  
    text-align: center;
  
    bottom:5px;
  }

  .textoBusqueda{
    margin-left: 20px;
    align: right;
    width: 60%;
  }

  .opcionesBusqueda{
    align: left;
    width:30%;
    }
    .white-popup {
    position: relative;
    background: #FFF;
    padding: 20px;
    width: auto;
 
    margin: 50px auto;
    text-align: center;
  }
  @media screen and (max-width: 500px) {
    .indice{
    align:center;
    width:100%;
    }
    .contenedor{
      width:100%;
      align:center;
    }
    .demo-gallery{
      width:225px;
      margin-left: auto;
      margin-right: auto;
    }
  
  }
  @media screen and (min-width: 600px) {
      .divgrid, .lightgallery{
      width:90%;
      margin-left: auto;
      margin-right: auto;
    }
    .demo-gallery{
      width:90%;
      margin-left: auto;
      margin-right: auto;

    }
    .white-popup {
    position: relative;
    background: #FFF;
    padding: 20px;
    width: 50%;
 
    margin: 50px auto;
    text-align: center;
    }
}
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 15px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

 .contAceptarCancelar{
   width: 100%;
 }


.demo-card-wide.mdl-card {
  width: 512px;
}
.demo-card-wide > .mdl-card__title {
  color: #fff;
  height: 100px;
  
}
.demo-card-wide > .mdl-card__menu {
  color: #fff;
}
.mdl-textfield__label{  
   margin-bottom:0px;
 }


</style>
@section('content')


<!--<div class="container" >
    <div class="row justify-content-center"  >
        <div class="col-md-8" >
            <div class="card">
                <div class="card-header">Tablero</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
    
                </div>
            </div>
        </div>
    </div>
</div>-->




<div id="mySidenav" class="sidenav" onClick="closeNav()">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#busqueda">About</a>
  <a href="#busqueda" class ="btnAgregarObjeto" >Agregar Objeto</a>
  <a href="#">Información</a>
  <a href="#">Editar</a>
</div>

<div class="card" style="width:90%;height:500px;margin: 0 auto; ">

<div  style="width:100%;height:500px;margin: 0 auto; " id="map" class="map"></div>
<div id="mouse-position" class="mouse-position"></div> 



<input type="hidden" id="_token" value="{{ csrf_token() }}">

</div>
  <div id="espere"  class="white-popup mfp-hide">
  </div>
 <!--bloques de popups INICIO-->
  <div id="busqueda"  class="white-popup mfp-hide">
      <h4 class="tituloBusqueda">Objeto Geométrico</h4>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
          <input type="text" value="" class="mdl-textfield__input" id="geometrico" readonly>
          <input type="hidden" value="" id="type" name="geom">
          <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
          <label for="geometrico" class="mdl-textfield__label" id="type">Tipo</label>
          <ul for="geometrico" class="geometrico mdl-menu mdl-menu--bottom-left mdl-js-menu">
              <li class="mdl-menu__item" value="None" data-val="None">Navegar</li>
              <li class="mdl-menu__item" value="Point" data-val="Point">Punto</li>
              <li class="mdl-menu__item" value="LineString" data-val="LineString">Linea</li>
              <li class="mdl-menu__item" value="Polygon" data-val="Polygon">Poligono</li>
              <li class="mdl-menu__item" value="Circle" data-val="Circle">Circulo</li>
          </ul>
        </div>   
     <!-- <form class="form-inline">
      <label>Tipo : &nbsp;</label>
      <select id="type">
        <option value="None">Navegar</option>
        <option value="Point">Punto</option>
        <option value="LineString">Linea</option>
        <option value="Polygon">Poligono</option>
        <option value="Circle">Circulo</option>
        
      </select>
      </form>-->
            
       
        <div class="mdl-card__actions mdl-card--border">
          <button class="aceptarGeom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Aceptar</button>
          <button class="cancelarGeom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Cancelar</button>
        </div>
  </div>

  <div id="geomPopup"  class="white-popup mfp-hide">

    <h4 class="tituloBusqueda">Datos de Objeto</h4>
    <div style="width:100%; "> 
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="titulo mdl-textfield__input" type="text" id="titulo">
      <label class="mdl-textfield__label" for="titulo">Titulo</label>
    </div>

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input class="mdl-textfield__input" type="text" id="descripcion">
      <label class="mdl-textfield__label" for="descripcion">Descripción</label>
    </div>


   </div>

    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
        <input type="text" value="" class="mdl-textfield__input" id="categoria" readonly>
        <input type="hidden" value="" name="categoria">
        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
        <label for="categoria" class="mdl-textfield__label">Categoria</label>
        <ul for="categoria" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
            <li class="mdl-menu__item" data-val="infraestructura">Infraestructura</li>
            <li class="mdl-menu__item" data-val="accidente">Accidente</li>
            <li class="mdl-menu__item" data-val="otro">Otro</li>
        </ul>
    </div>
   



   
    <div class="mdl-card__actions mdl-card--border">
      <button class="aceptarDatos mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Aceptar</button>
      <button class="cancelarGeom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Cancelar</button>
    </div>
  </div> 
   
  </div>
  <!--bloques de popups FIN-->


<div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>


</div>
@endsection

@section('view.scripts')

<script > 
    var j = jQuery.noConflict();
    var source = new ol.source.Vector({wrapX: false});
    var mapaPuntos;
    var dragPan;
    var zoomBox;
    var mousePointerStyle = 'default';
    var itemSel="ninguno";
    var map;
    var features;
    var featureOverlay;
    var modify;
    var draw;
    var source;
    var vector;
    var draw; // global so we can remove it later
    var typeSelect = document.getElementById('type');
    //window['counter'] = 0;
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var showToastButton = document.querySelector('#demo-show-toast');

    j.ajaxSetup({
        headers: { 'X-CSRF-Token' : j('meta[name=_token]').attr('content') }
      });
     //////////////////////////////////////////////////////// 
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
        //////////////////////////////////////////
    function closePopup(){
      var magnificPopup = j.magnificPopup.instance;
      magnificPopup.close();
    }
    
    

    function mapInicial(){
      var raster = new ol.layer.Tile({
        source: new ol.source.OSM()
      });

      

    var vector = new ol.layer.Vector({
        source: source
    });

    var map = new ol.Map({
        layers: [raster, vector],
        target: 'map',
        view: new ol.View({
          center: [-11000000, 4600000],
          zoom: 4
        })
      });
    }
      

   
    /*typeSelect.onchange = function() {
        var value = typeSelect.value;
        map.removeInteraction(draw);
        addInteraction(value);
      };*/
 //////////////////////////////////////////////////////////////////////////////////////////////   
    function ajaxRequest(dato,url) {

        j.ajax({
          type:"POST",  
          headers: {
            'X-CSRF-TOKEN': j('meta[name="csrf-token"]').attr('content')
          },
          dataType:"JSON",
         // url:'./postajax', //ojo con esta dire si en el server hay otra subcarpeta que contiene el laravel
          url:'./'+url,
          data:dato, //dato se lee en el servidor y va hacia el controler
                //data2 es lo que envia el servidor como respuesta
          success: function(data2){
            console.log(data2[0].lat);
                   
          },//fin sucess
          error: function (data, textStatus, errorThrown) {
            if (data.status===200){
              console.log(data.responseText);
              var data = {message: 'Transferencia completa.'};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
            }else if(data.status===500){
              var data = {message: 'Transferencia fallida.'};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
              console.log(data.responseText);
              return false;
            }
            console.log(data);

            },
          });//fin ajax
     }// fin ajaxrequest

 
  /* function cambiarPuntero(){
      features = new ol.Collection();

      featureOverlay = new ol.layer.Vector({
        source: new ol.source.Vector({features: features}),
        style: new ol.style.Style({
          fill: new ol.style.Fill({
            color: 'rgba(255, 255, 255, 0.2)'}),
            stroke: new ol.style.Stroke({
              color: '#ffcc33',
              width: 2
            }),
          image: new ol.style.Circle({
              radius: 7,
              fill: new ol.style.Fill({
                color: '#ffcc33'
              })
            })
        })
      });

      featureOverlay.setMap(map);
      modify = new ol.interaction.Modify({
        features: features,
          // the SHIFT key must be pressed to delete vertices, so
          // that new vertices can be drawn at the same position
          // of existing vertices
        deleteCondition: function(event) {
          return ol.events.condition.shiftKeyOnly(event) &&
            ol.events.condition.singleClick(event);
          }
      }); //fin modify
      map.addInteraction(modify);
         // var draw; // global so we can remove it later
      var typeSelect = document.getElementById('type');

    
      typeSelect.onchange = function() {
        map.removeInteraction(draw);
        addInteraction();
      };
      addInteraction();
   } */
     function olMapa(){
        var mousePositionControl = new ol.control.MousePosition({
          coordinateFormat: ol.coordinate.createStringXY(4),
          projection: 'EPSG:4326',
                // comment the following two lines to have the mouse position
                // be placed within the map.
          className: 'custom-mouse-position',
          arget: document.getElementById('mouse-position'),
          undefinedHTML: '&nbsp;'
        });
        map = new ol.Map({
          target: 'map',
          renderer: 'canvas',
          controls: ol.control.defaults({
            attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
            collapsible: false
            })}).extend([mousePositionControl]),
          layers: [new ol.layer.Tile({
                    source: new ol.source.OSM()
                  }),
          new ol.source.TileWMS({
            url: 'https://ahocevar.com/geoserver/wms',
            params: {'LAYERS': 'topp:states', 'TILED': true},
            serverType: 'geoserver',
            tileGrid: tileGrid})],
          view: new ol.View({
               //   rotation: 1
                 // center: ol.proj.transform([2.1833, 41.3833], 'EPSG:4326', 'EPSG:3857'),
                  //zoom: 6
                })
        }); //fin new olmap
     }//fin funcion olmapa
   /* function punto(){
            map.removeInteraction(draw);
            addInteraction("Point");
          }*/
         
    j(document).ready(function(){
 
      j('.toggle-btn').click(function(){
        j('.filter-btn').toggleClass('open');
      });
      j('.filter-btn a').click(function(){
        j('.filter-btn').removeClass('open');
      });
      

      j(".aceptarDatos").click(function(){
        var data = {message: 'El campo Título no puede estar vacío '};
        var titulo = document.getElementById('titulo').value;
        var descripcion=document.getElementById('descripcion').value;
        var categoria=document.getElementById('categoria').value;
        var nombre={!! auth()->user() !!};
        var id=nombre.id;

        var value = typeSelect.value;
        var x;
        var y;
       // console.log(titulo);
        if(titulo!=""){
          //si el titulo no es vacio borro el objeto y cierro ventana, luego vuelvo al PAN
         // map.removeInteraction(draw);
         //este envio es solo para punto
         /////////////////////////////////////////////////////////////

            
            var features = vector.getSource().getFeatures();
              features.forEach((feature) => {
                console.log(feature.N.geometry.A[0]);
                console.log(feature.N.geometry.A[1]);
                x=feature.N.geometry.A[0];
                y=feature.N.geometry.A[1];
               // cantPuntos=feature.N.geometry.A.length;
                colPuntos=feature.N.geometry.A;
                //vector.getSource().removeFeature(feature);
              });

              var dato={
                _token : j('meta[name="csrf-token"]').attr('content'), 
                "geom":typeSelect.value,
                "titulo":titulo,
                "user_id":id,
                "descripcion":descripcion,
                "categoria":categoria,
                "colPuntos":colPuntos,
                "x":x,
                "y":y
              };
            ajaxRequest(dato,value);//el value lleva implicita la direccion del request de ajax


         //////////////////////////////////////////////////////////////
      /*    if(value=="Point"){
              var features = vector.getSource().getFeatures();
              features.forEach((feature) => {
                console.log(feature.N.geometry.A[0]);
                console.log(feature.N.geometry.A[1]);
                x=feature.N.geometry.A[0];
                y=feature.N.geometry.A[1];
                //vector.getSource().removeFeature(feature);
              });

              var dato={
                _token : j('meta[name="csrf-token"]').attr('content'), 
                "geom":typeSelect.value,
                "titulo":titulo,
                "user_id":id,
                "descripcion":descripcion,
                "categoria":categoria,
                "x":x,
                "y":y
              };
               ajaxRequest(dato);
          }else if(value=="LineString"){
             var features = vector.getSource().getFeatures();
             contPuntos=0;
             //entra una sola vez siempre, porque se hace solo un objeto grafico
            features.forEach((feature) => {
               contPuntos++;
                console.log(feature.N.geometry.A[0]);
                console.log(feature.N.geometry.A[1]);
                x=feature.N.geometry.A[0];
                y=feature.N.geometry.A[1];
                cantPuntos=feature.N.geometry.A.length;
                colPuntos=feature.N.geometry.A;
                //vector.getSource().removeFeature(feature);
              });
            console.log("linea mande "+cantPuntos);
            var dato={
                _token : j('meta[name="csrf-token"]').attr('content'), 
                "geom":typeSelect.value,
                "titulo":titulo,
                "user_id":id,
                "descripcion":descripcion,
                "categoria":categoria,
                "colPuntos":colPuntos,
                "x":1,
                "y":1
              };
           
            
            console.log(features);
           
            ajaxRequest(dato);
          }else if(value=="Polygon"){
            var dato={
                _token : j('meta[name="csrf-token"]').attr('content'), 
                "geom":typeSelect.value,
                "titulo":titulo,
                "user_id":id,
                "descripcion":descripcion,
                "categoria":categoria,
                
                "x":1,
                "y":1
              };
            var features = vector.getSource().getFeatures();
            console.log("poli mande");
            console.log(features);
            ajaxRequest(dato);
          }*/
         
          console.log(dato);

          ///////////////////CREAR UNA VENTANA DE ESPERA///////////////////////////////////////////////////
              j.magnificPopup.open({
              items: [{
              src: '#espere',
              type: 'inline'}],
              modal:true,
              index: 2
            });

         // ajaxRequest(dato);
          map.removeInteraction(draw);
          addInteraction(value);
          var magnificPopup = j.magnificPopup.instance;
          magnificPopup.close();
          //addInteraction("None");
         // borrarGeoms();
         //no se borra el ultimo punto para que quede en la tesela
          map.removeInteraction(draw);
          addInteraction("None");  

                //var user=
              /*  dato={
                    _token : j('meta[name="csrf-token"]').attr('content'), 
                    "coordenada":"scoorddd",
                    "user_id":id,
                    "lat":lat,
                    "lon":lon
                };
                ajaxRequest(dato);*/
         // map.removeInteraction(draw);
         // addInteraction(value);
        }else{
          snackbarContainer.MaterialSnackbar.showSnackbar(data);
        }

       /* if(titulo=""){
          snackbarContainer.MaterialSnackbar.showSnackbar(data);
        }else{
          
          map.removeInteraction(draw);
          addInteraction(value);
          var magnificPopup = j.magnificPopup.instance;
          magnificPopup.close();
        }*/
        
      });
      ////////////////////////////////////////////////////////////////////////////////////
      j(".aceptarGeom").click(function(){
        var data = {message: 'Elija una geometría (solo puntos.. web en desarrollo)'};
        //var tipo = document.getElementById('geometrico').value;
        var value = typeSelect.value;
        console.log(value);
        if(value!="" && value=="Point" || value=="LineString" || value=="Polygon"){
          //borro geometrias anteriores
          borrarGeoms();
          map.removeInteraction(draw);
          //agrego la nueva interaccion
          addInteraction(value);
          var magnificPopup = j.magnificPopup.instance;
          magnificPopup.close();
         //var fuente = mapaPuntos.TileWMS.getSource();
          //var fuente=mapaPuntos.getSource();
        //  fuente.TileWMS.ex
          //fuente
          //map.refresh();
         // mapaPuntos.refresh({force:true});
        }else{
          if (value=="LineString"){
              console.log("linea");
          }
          snackbarContainer.MaterialSnackbar.showSnackbar(data);
        /*  map.removeInteraction(draw);
          addInteraction(value);
          var magnificPopup = j.magnificPopup.instance;
          magnificPopup.close();*/
        }

      });
      function borrarGeoms(){
         var features = vector.getSource().getFeatures();
          features.forEach((feature) => {
            console.log(feature.N.geometry.A[0]);
            vector.getSource().removeFeature(feature);
            });
          map.removeInteraction(draw);
          addInteraction("None");
         // vector.getSource().refresh();
          //features.refresh();
      }
      j(".cancelarGeom").click(function(){
 
       /* var value = typeSelect.value;
        map.removeInteraction(draw);
        addInteraction(value);*/
        var magnificPopup = j.magnificPopup.instance;
        magnificPopup.close();
        borrarGeoms();
      });


      j('.btnAgregarObjeto').magnificPopup({
            type: 'inline',
            modal:true
        });
      j( "#open-hide" ).click(function() {
        j( this ).toggleClass( "show" );
      });
      //////////////////////////////////////////////////////////////////

      var raster = new ol.layer.Tile({
        source: new ol.source.OSM()
      });

     // source = new ol.source.Vector({wrapX: false});

      vector = new ol.layer.Vector({
        source: source
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
        mapaPuntos
       /* new ol.layer.Tile({
          source: new ol.source.TileWMS({
            url: 'https://ahocevar.com/geoserver/wms',
            params: {'LAYERS': 'topp:states', 'TILED': true},
            serverType: 'geoserver'
          })
        })*/
      ];

      var mousePositionControl = new ol.control.MousePosition({
        coordinateFormat: ol.coordinate.createStringXY(4),
        projection: 'EPSG:3857',
        //projection: 'EPSG:4326',
            // comment the following two lines to have the mouse position
            // be placed within the map.
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
     // var extent = features.getExtent();
     // console.log(extent);
      //map.getView().fit([-6573309.837848, -4181128.045259, -6494542.197549, -4111229.486657], map.getSize());
       //map.getView().fit([-59.3852, -34.5891, -58.0257, -35.1412], map.getSize());
      var typeSelect = document.getElementById('type');
      //var puntero=typeSelect.value;
      var draw; // global so we can remove it later
///////luego del click de edicion, abre popup modal/////////////
      function addInteraction(value) {

        if (value !== 'None') {
          draw = new ol.interaction.Draw({
            source: source,
            type: /** @type {ol.geom.GeometryType} */ (value)
          });

          map.addInteraction(draw);
          draw.on('drawend', function () {

            j.magnificPopup.open({
              items: [{
              src: '#geomPopup',
              type: 'inline'}],
              modal:true,
              index: 2
            });
            console.log("termino");
          });
        }
      }

////////////////////////////////////////
      /**
       * Handle change event.
       */
      typeSelect.onchange = function() {
        var value = typeSelect.value;
        map.removeInteraction(draw);
        addInteraction(value);
      };

      addInteraction('None');

      ///////////////////////////////////////////////////////////////////
     // olMapa();
     //mapInicial();
     // addInteraction();
  // addInteraction();
       // map.getView().fit([-6573309.837848, -4181128.045259, -6494542.197549, -4111229.486657], map.getSize());
        //addCtrl();
      /*  map.on('singleclick', function(evt) {
            var coordenada = evt.coordinate;
            var lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
            var lat=lonlat[0].toFixed(5);
            var lon=lonlat[1].toFixed(5);
            var nombre={!! auth()->user() !!};
            var id=nombre.id;
            console.log(nombre.id);
            //var user=
            dato={
                _token : j('meta[name="csrf-token"]').attr('content'), 
                "coordenada":"scoorddd",
                "user_id":id,
                "lat":lat,
                "lon":lon
            };
            ajaxRequest(dato);
            
            
            var hdms = ol.coordinate.toStringHDMS(ol.proj.transform(
            coordenada, 'EPSG:3857', 'EPSG:4326'));
            //var hdms2 = ol.coordinate.toStringHDMS(ol.proj.toLonLat(coordenada));
            //var hdms2 = ol.coordinate.toStringHDMS(coordenada);
            console.log("lat: "+lat+ " lon: "+lon);

        });*/
        //fin de click en el mapa
     /*   dato={
            _token : j('meta[name="csrf-token"]').attr('content'), 
            "coordenada":"sss"
        };
        j.ajax({
              type:"POST",  
              headers: {
                'X-CSRF-TOKEN': j('meta[name="csrf-token"]').attr('content')
                },
              dataType:"JSON",
              url:'./postajax', //ojo con esta dire si en el server hay otra subcarpeta que contiene el laravel
              data:dato, //dato se lee en el servidor y va hacia el controler
              //data2 es lo que envia el servidor como respuesta
              success: function(data2){
                  console.log(data2[0].coordenada);
                 
              },//fin sucess
              error: function (data, textStatus, errorThrown) {
                  if (data.status===200){
                      console.log(data.responseText);
                  }
                console.log(data);

                },
        });//fin ajax
        */
        j('.envio').click(function(){
     
        console.log("ajsjsj");

        });
    });
    
    </script>

@endsection
