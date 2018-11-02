@extends('layouts.app')
<style>
.mdl-js-snackbar .mdl-snackbar{
  position:absolute;

}
.white-popup{
  position:absolute;
}
.tipoGeometria{
  width: 50%;
}
.tipoGeometria {
   margin:10px auto 10px auto;  
   border:1px solid #d9d9d9;
   height:30px;
   overflow: hidden;
   width: 90%;
   position:relative;
}
.lblCategoria{
  position:relative;
  margin:0px 0px 0px 0px;
  text-align:center;
  color: #3f51b5;
  font-size: 12px;
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


<div id="mySidenav" class="sidenav"  onClick="closeNav()">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#busqueda" class ="btnAbout">About</a>
  <a href="#busqueda" class ="btnAgregarObjeto" >Agregar Objeto</a>
  <a href="#" id="btnInformacion" class ="btnInformacion">Información</a>
  <a href="#" id="btnBuscar"  class ="btnBuscar">Buscar</a>
  <a href="#" id="btnMisDatos"  class ="btnMisDatos">Mis Datos</a>
  <a href="#" id="btnMiPos"  class ="btnMiPos">Mi Posición</a>
</div>

<div class="card" style="width:90%;height:500px;margin: 0 auto; ">

  <div  style="width:100%;height:500px;margin: 0 auto; " id="map" class="map"></div>
  <div id="mouse-position" class="mouse-position"></div> 

  <input type="hidden" id="_token" value="{{ csrf_token() }}">

</div>
  <div id="espere"  class="white-popup mfp-hide"></div>
 
 <div id="choseGeom"   class="white-popup mfp-hide">
      <h4 class="tituloBusqueda">Objeto Geométrico</h4>

        <div>
        <select id="type" class="tipoGeometria">
          <option value="Point">Punto</option>
          <option value="LineString">Linea</option>
        </select>  
        </div>
        <br>
        <div class="mdl-card__actions mdl-card--border">
          <button class="aceptarGeom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Aceptar</button>
          <button class="cancelarGeom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Cancelar</button>
        </div>

  </div>

  <div id="geomPopup" style="width:380px;height:auto;" class="white-popup mfp-hide">

    <h4 class="tituloBusqueda">Datos de Objeto</h4>
    <div id="mensajeError" style="display:none;color: red;" class="mensajeError"></div>
    <div style="width:100%;"> 
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="titulo mdl-textfield__input" type="text" id="titulo">
        <label class="mdl-textfield__label" for="titulo">Titulo</label>
      </div>

      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="descripcion">
        <label class="mdl-textfield__label" for="descripcion">Descripción</label>
      </div>
    </div>

    <div class="lblCategoria">Categoría</div>
    <div>
        <select name="categoria" id="categoria" class="tipoGeometria">
           @foreach ($catOptions as $cat)
              <option value="{{$cat}}">{{$cat}}</option>
            @endforeach
        </select>  
    </div>

    <br>

    <form action="{{ url('perfil/foto') }}" method="post" style="display: none" id="avatarForm2">
        {{ csrf_field() }}
        <input type="file"  id="avatarInput2" name="photo2" accept="image/*" onclick="this.value=null;">
    </form>
        <img  style="max-width:300px;height: 300px; " src="{{ asset('images/users/default3.jpg') }}" id="avatarImage2" >


    <div class="mdl-card__actions mdl-card--border">
      <button class="aceptarDatos mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Aceptar</button>
      <button class="cancelarGeom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Cancelar</button>
    </div>

  </div>

<div id="buscarPopup"  class="white-popup mfp-hide">

    <h4 class="tituloBusqueda">Buscar Registros</h4>
    

    <div class="lblCategoria">Categoría</div>
    <div>
        <select name="categoriaBusqueda" id="categoriaBusqueda" class="tipoGeometria">
           @foreach ($catOptions as $cat)
              <option value="{{$cat}}">{{$cat}}</option>
            @endforeach
        </select>  
    </div>

    <br>

    <div class="mdl-card__actions mdl-card--border">
      <button class="aceptarBusqueda mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Aceptar</button>
      <button class="cancelarBusqueda mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Cancelar</button>
    </div>

</div>



<div id="geomInfo" class="white-popup mfp-hide">

    <h4 class="tituloBusqueda">Info de Objeto</h4>
    <div class="nuser" id="datosUsuario">Nusuario: 

    </div>

       <ul class="demo-list-three mdl-list">
      <li class="mdl-list__item mdl-list__item--three-line">
        <span class="mdl-list__item-primary-content">

          <span>Título</span>
          <span class="mdl-list__item-text-body">
            <div id="nodelist">
              <em>Click on the map to get feature info</em>
            </div>
          </span>
        </span>
       
      </li>
      <li class="mdl-list__item mdl-list__item--three-line">
        <span class="mdl-list__item-primary-content">
          <span>Descripción</span>
          <span class="mdl-list__item-text-body">
            <div id="infoDescripcion">
              
            </div>
          </span>
        </span>
       
      </li>
      <li class="mdl-list__item mdl-list__item--three-line">
        <span class="mdl-list__item-primary-content">

          <span>Categoría</span>
          <span class="mdl-list__item-text-body">
           <div id="infoCategoria">
             
           </div>
          </span>
        </span>
       
      </li>
    </ul>
 <img  style="max-width:300px;height: 300px; " src="{{ asset('images/users/default3.jpg') }}" id="infoImage">
<!--<div style="width:300px;height:300px;align: center; " id="mapInfo" class="mapInfo"></div>-->

    <div class="mdl-card__actions mdl-card--border">
      <button class="copiarLink mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Link</button>
      <button class="zoom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Zoom</button>
      <button class="cerrarInfo mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Cerrar</button>
    </div>

  </div>


  <!--popup edicion -->

   <div id="geomEdicion"   class="white-popup mfp-hide">

    <h4 class="tituloBusqueda">Datos de Objeto</h4>
    <div class="nuser" id="datosUsuario">Nusuario:   
    </div>
    <div id="mensajeError" style="display:none;color: red;" class="mensajeError"></div>
    <div > 
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="titulo mdl-textfield__input" type="text" id="titulo">
        <label class="mdl-textfield__label"  for="titulo">Titulo</label>
      </div>
      <input type="hidden" id="hiddenIdGeom" value="vacio" name="hiddenIdGeom">
      <input type="hidden" id="hiddenTypeGeom" value="vacio" name="hiddenTypeGeom">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="descripcion">
        <label class="mdl-textfield__label" for="descripcion">Descripción</label>
      </div>
      <div class="lblCategoria">Categoría</div> 
    <div>
        <select name="categoria" id="categoria" class="tipoGeometria">
           @foreach ($catOptions as $cat)
              <option value="{{$cat}}">{{$cat}}</option>
            @endforeach
        </select>  
    </div>

    </div>

    <br>

    <form action="{{ url('perfil/foto') }}" method="post" style="display: none" id="avatarForm">
        {{ csrf_field() }}
        <input type="file" id="avatarInput" name="photo" onclick="this.value=null;">
    </form>
        <img style="max-width:300px;height: 300px; " src="{{ asset('images/users/default3.jpg') }}" id="avatarImageInfo">


    <div class="mdl-card__actions mdl-card--border">
      <button class="aceptarDatosInfo mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Aceptar</button>
      <button class="borrarGeomBD mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Borrar</button>
      <button class="cancelarGeom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Cancelar</button>
    </div>

  </div>
<!--popup aviso -->

   <div id="geomAviso" style="width:390px;" class="white-popup mfp-hide">

    <h4 class="tituloBusqueda">Confirmación</h4>
    <div class="aviso" id="aviso">¿Esta seguro de eliminar este registro de su base de datos? 
    
   
    </div>

    <br>

    <div class="mdl-card__actions mdl-card--border">
      <button class="borrarGeomConfirmacion mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Aceptar</button>

      <button class="cancelarGeom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Cancelar</button>
    </div>

  </div>
  <!--popup mis datos -->

   <div id="test-popup" class="white-popup mfp-with-anim mfp-hide">
      <h4 class="tituloBusqueda">Mis Datos</h4>
      <div class="popup-scroll">
        
    <table class=" mdl-data-table mdl-js-data-table  mdl-shadow--2dp">
      <thead>
        <tr>
          <th>Id</th>
          <th class="mdl-data-table__cell--non-numeric">Enlace</th>
          <th class="mdl-data-table__cell--non-numeric">Tipo</th>
          <th class="mdl-data-table__cell--non-numeric">Titulo</th>
          <th class="mdl-data-table__cell--non-numeric">Categoria</th>
          <th class="mdl-data-table__cell--non-numeric">Descripcion</th>
          <th class="mdl-data-table__cell--non-numeric">Fecha</th>
        
        </tr>
      </thead>

      <tbody class="cuerpoTabla" id="cuerpoTabla">

      </tbody>
    </table>

  </div>
  <div class="mdl-card__actions mdl-card--border">


      <button class="cancelarGeom mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Cerrar</button>
    </div>
  </div>

    <br>
  <!--bloques de popups FIN-->

</div>

<div id="demo-toast-example" style="position:absolute;z-index: 2;" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<!--<div id="dialog" title="Dialogo básico">
<p>Diálogo básico modal. Puede ser movido, redimensionado y cerrado haciendo clic sobre el botón 'X'.</p>
</div>-->
@endsection

@section('view.scripts')

<script > 
    var j = jQuery.noConflict();
//necesito declarar estas globales para poder setear el nombre de la foto segun el usuario y el id de la foto
    var geomType;
    var featureIdN;
    var usuario;
    const sinFoto="default3.jpg";
   // var urlInfoPoint="./InfoPoint";
    var source = new ol.source.Vector({wrapX: false});
   // var mapaPuntos;
    var nombreFoto=sinFoto; // este nombre se almacenara en la tabla de la geom cuando se de aceptar
    var editando=false;
   // var extensionFoto;
   // var dragPan;
    //var zoomBox;
   // var mousePointerStyle = 'default';
    //var itemSel="ninguno";
    var map;
    var formData; //datos del formulario de carga de imagen, lo hago global porque lo necesito en la funcion que dispara el requerimiento ajax, aca contiene el nombre de la imagen y todos los datos necesarios para enviar al controlador
   // var features;
    //var featureOverlay;
    //var modify;
    var draw;
    //var source;
    var vector;
   // var vector2;
    //var draw; // global so we can remove it later
    var typeSelect = document.getElementById('type');
    var usoPuntero="navegando";
    var coordenada;
   // var resConsultaPuntos;
    //window['counter'] = 0;
    var snackbarContainer = document.querySelector('#demo-toast-example');
    var showToastButton = document.querySelector('#demo-show-toast');

    j.ajaxSetup({
        headers: { 'X-CSRF-Token' : j('meta[name=_token]').attr('content') }
      });
     //////////////////////////////////////////////////////// 
    function openNav() {
      if (editando!=true){

        document.getElementById("mySidenav").style.width = "250px";
      }
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
  
    function closePopup(){//funcion que cada vez que es llamada cierra todas las instancias del popup
      var magnificPopup = j.magnificPopup.instance;
      magnificPopup.close();
    }

    //var resCallBackMisDatos;
    var glbResponse;//toda la coleccion global porque no se lo puedo pasar por la llamada del html
    function enlaceGeom(idGeom){//funcion llamada desde la tabla de geoms a su vez llama a la ventana de edicion
      j.magnificPopup.open({
        items: [{
        src: '#geomEdicion',
        type: 'inline'}],
        modal:true,
        index: 2
      });
      var titulo=glbResponse[idGeom].titulo;
      var descripcion=glbResponse[idGeom].comentario;
      var categoria=glbResponse[idGeom].categoria;
      var foto=glbResponse[idGeom].foto;
      nombreFoto=foto; //seteo por si es la primera entrada, sino queda en default3 si almaceno la info
      var creationDate=glbResponse[idGeom].updated_at;
      geomType=glbResponse[idGeom].location.type; //global para definir el nombre de la foto cargada
      var featureId=glbResponse[idGeom].id; 
      featureIdN=featureId; //aqui no necesito hacer la separacion del punto porque la consulta no se hace al geoserver con un punto sino con el id de la geometria perteneciente al usuario
      var editable="editable"; //llegado a este punto siempre es editable ya que llego aca desde mis datos
      usuario=glbResponse[idGeom].user_id;//global para definir el nombre de la foto cargada
      if (geomType=="Point"){ //la coordenada en una linea esta en otro lugar de la coleccion
        var coordenada=glbResponse[idGeom].location.coordinates;
      }else{
        var coordenada=glbResponse[idGeom].location.coordinates[0];//zoom al comienzo de la linea
      }
      
      if (foto!=sinFoto){//foto de la base de datos si hay foto
          var urlFoto={!!json_encode(asset('images/users/'))!!}+"/"+foto;
      }else{
          var urlFoto={!!json_encode(asset('images/users/'))!!}+"/"+sinFoto;
      } 
      document.querySelector('#titulo').parentNode.MaterialTextfield.change(titulo);
      document.querySelector('#descripcion').parentNode.MaterialTextfield.change(descripcion);
      document.getElementById('categoria').value=categoria;
      document.getElementById('hiddenIdGeom').value = featureId;
      document.getElementById('hiddenTypeGeom').value = geomType;
      //encierro el subtitulo en divs para poder recuperarlos par anombrar la foto y no tener quehacer variables globales
      document.getElementById('datosUsuario').innerHTML =  "#usuario: "+usuario+" |"+"Creación: "+creationDate+" | "+"Tipo: "+geomType+" | "+"#idGeom: "+featureId+" | "+editable;
      $avatarImageInfo.attr('src', urlFoto);
      map.getView().animate({center: coordenada, zoom: 15}); //luego de precionar el boton de enlace se hace zoom al objeto
    } //fin enlaceGeom

    function myCallback(response) {//la manera de recuperar el dato devuelto por ajaxrequest---la unica vez que necesito que el controlador ajaxcontroller me devuelva una coleccion de valores es en la consulta a la bd de todos los datos del usuario logeado (Mis Datos), el resto, C ->create, se llama al ajaxrequest con la url de creacion de geometria, U-> sellama al ajaxrequest con la url de updatear geometria, R->se llama al ajaxrequest con una url que ejecuta un comando de consulta al geoserver desde laravel (ya que este trabajo no se puede hacer desde ajax por referencia cruzada), D-> basicamente se borra una geometria en la bd
      var rows="";
      var cantRegisters=response.length;
      if (cantRegisters!=0){//si hay registro lleno la tabla con estilo material design
        for (var i = 0; i < response.length; i++) {
        rows+='<tr><td>'+i+'</td><td class="mdl-data-table__cell--non-numeric"><img class="imgEnlace" src="{{URL::asset('images/icons/baseline_link_black_18dp.png')}}" onclick="enlaceGeom('+i+')" alt="Smiley face" height="20" width="20"></td><td class="mdl-data-table__cell--non-numeric">'+response[i].location.type+'</td><td><input type="text" value="'+response[i].titulo+'" class="field left" readonly></td><td>'+response[i].categoria+'</td><td><input type="text" value="'+response[i].comentario+'" class="field left" readonly></td><td class="mdl-data-table__cell--non-numeric">'+response[i].updated_at+'</td></tr>';  
        }
      }else{ //si no hay registro lleno con un campo ficticio
        rows='<tr><td>0</td><td class="mdl-data-table__cell--non-numeric"><img class="imgEnlace" src="{{URL::asset('images/icons/baseline_link_black_18dp.png')}}" alt="Smiley face" height="20" width="20"></td><td class="mdl-data-table__cell--non-numeric">Sin Registro</td><td><input type="text" value="Sin Registro" class="field left" readonly></td><td>Sin Registro</td><td><input type="text" value="Sin Registro" class="field left" readonly></td><td class="mdl-data-table__cell--non-numeric">Sin Registro</td></tr>';
      }
      
      glbResponse=response;
      document.getElementById('cuerpoTabla').innerHTML =rows;
    
    } //fin funcion myCallback

    function ajaxRequest(dato,url) {//la interface general para todas las consultas al servidor php, la variable url se setea en quien pide el requerimiento y obviamente debe coincidir con la ruta del controlador en web.php

        j.ajax({
          type:"POST",  
          headers: {
            'X-CSRF-TOKEN': j('meta[name="csrf-token"]').attr('content'),
            'Access-Control-Allow-Credentials' : true,
            'Access-Control-Allow-Origin':'*',
            'Access-Control-Allow-Methods':'GET',
            'Access-Control-Allow-Headers':'application/json',
          },
          dataType:"JSON",
         // url:'./postajax', //ojo con esta dire si en el server hay otra subcarpeta que contiene el laravel
          url:'./'+url,
          data:dato, //dato se lee en el servidor y va hacia el controler               
          success: myCallback,//necesario para compartir el retorno con el hilo principal
          error: function (data, textStatus, errorThrown) {
            if (data.status===200){
              var data = {message: 'Transferencia completa.'};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
            }else if(data.status===500){
              var data = {message: 'Transferencia fallida.'};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
              return false;
            }
            console.log(data);

            },
          });//fin ajax

     }// fin ajaxrequest


    j(document).ready(function(){

      j('.toggle-btn').click(function(){
        j('.filter-btn').toggleClass('open');
      });
      j('.filter-btn a').click(function(){
        j('.filter-btn').removeClass('open');
      });
      j('.btnInformacion').click(function(){//cuando se presiona el item de informacion en el menu principal seteo la global usopuntero para luego en el click en el mapa decidir, porque tambien el click puede ser para editar una geometria, en  este caso indico que lo que voy a hacer es informar sobre el click. de todas maneras en la informacion de un objeto si ese objeto es propiedad del usuario actual, puede editarse, por lo tanto con esto evite poner un item de edicion en el menu principal.
        usoPuntero="informando";
        //ojo en este punto porque al arrepentirse y no hacer click en el mapa e ir a otro menu del mapa este uso del puntero queda seteado
      });
      j('.btnInformacion').click(function(){
      });
      j('.btnMisDatos').click(function(){ //boton en el menu de inicio
        var nombre={!! auth()->user() !!};
        var id=nombre.id;
        var urlmisDatos="misDatos";
        var dato={
          _token : j('meta[name="csrf-token"]').attr('content'), 
          "user_id":id,
        };
        j.magnificPopup.open({
          items: [{
          src: '#test-popup',
          type: 'inline'}],
          modal:true,
          overflowY:'scroll',
          index: 2
        });

        ajaxRequest(dato,urlmisDatos);

      });//fin mis datos
      j('.btnMiPos').click(function(){ //boton en el menu de inicio
         if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
            alert("El browser no soporta las funciones de geolocacion");
          }
      });
      function showPosition(position) {
        var coord=[position.coords.longitude,position.coords.latitude];
        var coord3857=ol.proj.fromLonLat(coord, 'EPSG:3857');
        map.getView().animate({center: coord3857, zoom: 15});
      }
      j('.btnEdicion').click(function(){//no se usa
        usoPuntero="editando";
      });
      var $avatarImage, $avatarInput, $avatarForm,$infoImage,$avatarImage2, $avatarInput2, $avatarForm2,$infoImage2;
      $avatarImageInfo=j('#avatarImageInfo');
      $avatarImage = j('#avatarImage');
      $infoImage = j('#infoImage');
      $avatarInput = j('#avatarInput');
      $avatarForm = j('#avatarForm');
      $fotoFile=j('#subirFoto');
      $avatarImageInfo2=j('#avatarImageInfo2');
      $avatarImage2 = j('#avatarImage2');
      $infoImage2 = j('#infoImage2');
      $avatarInput2 = j('#avatarInput2');
      $avatarForm2 = j('#avatarForm2');
      $fotoFile2=j('#subirFoto2');
      $avatarImage2.on('click', function () {
          $avatarInput2.click();

      });
      $avatarImageInfo.on('click', function () {
         $avatarInput.click();

      });
      $avatarImageInfo2.on('click', function () {
         $avatarInput2.click();
      });
   ////////////////refresco de imagen del popup de info/////////////////////////

      function fileOnload(e) {
        var result=e.target.result;
        $('#avatarImageInfo').attr("src",result);
       }
      function addImage(e){
        var file = e.target.files[0],
        imageType = /image.*/;
        
        if (!file.type.match(imageType)){
          console.log("matcheo");
         return;
        }
    
        var reader = new FileReader();
        reader.onload = fileOnload;
        reader.readAsDataURL(file);
      }

   ///////////////refresco de imagen del popup de creacion////////////////////

      function fileOnload2(e) {
        console.log("2");
          var result=e.target.result;
          $('#avatarImage2').attr("src",result);
       }

      function addImage2(e){
        var file = e.target.files[0],
        imageType = /image.*/;    
        
        if (!file.type.match(imageType)){
          console.log("matcheo2");
         return; 
        }
        var reader = new FileReader();
        reader.onload = fileOnload2;
        reader.readAsDataURL(file);
      }
      function ajaxSubirImg(){ //subo la imagen solo cuando le doy aceptar al geomedicion
        $.ajax({
              url: $avatarForm2.attr('action') + '?' + $avatarForm2.serialize(),
              method: $avatarForm2.attr('method'),
              data: formData,
              processData: false,
              contentType: false
          }).done(function (data) {
              if (data.success){
                console.log("data path "+data.path);

              }
               
          }).fail(function () {
            console.log("error de imagen");
              document.getElementById("mensajeError").style.display="";
              document.getElementById("mensajeError").innerHTML="El formato del archivo no es correcto, ingrese una imagen.";
              window.setTimeout(mensajeError, 3000);
            
          });
      } //fin subir img
       function ajaxSubirImg2(){ //subo la imagen solo cuando le doy aceptar al geompopup
       // console.log("ajaxSubirImg2() "+$avatarForm.attr('action') + '?' + $avatarForm.serialize());
        $.ajax({
              url: $avatarForm.attr('action') + '?' + $avatarForm.serialize(),
              method: $avatarForm.attr('method'),
              data: formData,
              processData: false,
              contentType: false
          }).done(function (data) {
              if (data.success){

              }
               
          }).fail(function () {
console.log("error de imagendddd");
              document.getElementById("mensajeError").style.display="";
              document.getElementById("mensajeError").innerHTML="El formato del archivo no es correcto, ingrese una imagen.";
              window.setTimeout(mensajeError, 3000);
            
          });
      } //fin subir img
//tuve que hacer dos entradas de imagen porque sino una me influia en los nombres de imagen de la otra, en el caso de avatarimput2 lo que hago es disparar la carga de imagen con el boton aceptar ddel popup (ajaxsubirimg)
    $avatarInput2.on('change', function (e) { //esto captura el cambio de la imagen en el popup de creacion de geometria
        var nombreAleatorio=Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 10);
        nombreFotoCExtension=$avatarInput2[0].files[0].name; //detecto la extension del usuario
        var ext= nombreFotoCExtension.split('.')[1];
        nombreFoto=nombreAleatorio+"."+ext;//basicamente le cambio el nombre a la foto que ingresa el usuario
        var tipo=$avatarInput2[0].files[0].type;

        var ext=getType(tipo);
      if(ext=="error"){ //si no e suna imagen, salgo
        document.getElementById("mensajeError").style.display="";
        document.getElementById("mensajeError").innerHTML="El formato del archivo no es correcto, ingrese una imagen.";
        window.setTimeout(mensajeError, 3000);
        return false;
      }
        formData = new FormData();
        formData.append('photo', $avatarInput2[0].files[0]);
        console.log("cambie nomb foto "+ nombreFoto);
        formData.append('nombreFoto', nombreFoto);
        addImage2(e);//esta funcion cambia la imagen del popup pero a diferencia de avatarimput no se envia al servidor hasta queno se da aceptar
     });//fin avatar imput 2
      $('#photo[type=file]').click(function(){
    //$(this).attr("value", "");
    
      }) 
      function getType(tipo){
        
       switch(tipo) {
        case "image/png":
          return ".png"
        break;
        case "image/gif":
          return ".gif"
        break;
        case "image/bmp":
          return ".bmp"
        break;
        case "image/jpeg":
          return ".jpg"
        break;
        default:
          return "error"
        }
      }
    $avatarInput.on('change', function (e) {//imagen en editar info popup
      var nombreAleatorio=Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 10);
      nombreFotoCExtension=$avatarInput[0].files[0].name; //detecto la extension del usuario
      var tipo=$avatarInput[0].files[0].type;
      
      //var ext= nombreFotoCExtension.split('.')[1];
      var ext=getType(tipo);
      if(ext=="error"){ //si no e suna imagen, salgo
        document.getElementById("mensajeError").style.display="";
        document.getElementById("mensajeError").innerHTML="El formato del archivo no es correcto, ingrese una imagen.";
        window.setTimeout(mensajeError, 3000);
        return false;
      }
      if(nombreFoto==sinFoto){//en este punto se hizo una consulta a un punto ya creado, para evitar el problema del almacenamiento de una nueva imagen con el nombre default3, lo que hago es preguntar si el nombre recuperado de la bd (seteado en la creacion del geompopupinfo) es igual al nombre por defecto de la imagen, si es igual, entonces supongo que elegi una imagen nueva y le asigno un nombre aleatorio para sobreescribir en la base de datos en vez de la unica imagen default3 (que debe servir para todos los puntos)
        nombreFoto=nombreAleatorio+"."+ext;
      }
      formData = new FormData();
      formData.append('photo', $avatarInput[0].files[0]);
      formData.append('nombreFoto', nombreFoto);
      addImage(e);
      /*$.ajax({
          url: $avatarForm.attr('action') + '?' + $avatarForm.serialize(),
          method: $avatarForm.attr('method'),
          data: formData,
          processData: false,
          contentType: false
      }).done(function (data) {
          if (data.success)
            console.log("data path "+data.path);
            $avatarImage.attr('src', data.path+"?timestamp=" + new Date().getTime());//refresco la imagen si agrego un nuevo geom o si edito uno ya hecho (imageinfo)
            $avatarImageInfo.attr('src',data.path+"?timestamp=" + new Date().getTime());
           // nombreFotoCExtension="";
           // nombreFoto="foto";
      }).fail(function () {
          document.getElementById("mensajeError").style.display="";
          document.getElementById("mensajeError").innerHTML="El formato del archivo no es correcto, ingrese una imagen.";
          window.setTimeout(mensajeError, 3000);
        
      });*/
    });//fin avatar input

    /////////////////////////////////////////////////////////////////////////////
    j(".btnBuscar").click(function(){    
      j.magnificPopup.open({
        items: [{
        src: '#buscarPopup',
        type: 'inline'}],
        modal:true,
        index: 2
      });
    });

    j(".cancelarBusqueda").click(function(){
       closePopup();
    });
    j(".aceptarBusqueda").click(function(){
      var categoria=document.getElementById('categoriaBusqueda').value;
      var urlEdit="Buscar";
      var dato={
        _token : j('meta[name="csrf-token"]').attr('content'), 
        "categoria":categoria,
      };
      closePopup();
      j.magnificPopup.open({
          items: [{
          src: '#test-popup',
          type: 'inline'}],
          modal:true,
          overflowY:'scroll',
          index: 2
        });
      ajaxRequest(dato,urlEdit);
    });
///////////////////////////////////////////////////////////////////////////
    j(".aceptarDatosInfo").click(function(){  //se almacena en la bd segun el id del geom (solo se dispara esto en la ventana de informacion editable)
      //console.log("adeptar datosinfo "+nombreFoto);
      var titulo = document.getElementById('titulo').value;
      var descripcion=document.getElementById('descripcion').value;
      var categoria=document.getElementById('categoria').value;
      var nombre={!! auth()->user() !!};
      var id=nombre.id;
      var idGeom=document.getElementById('hiddenIdGeom').value;
      var TypeGeom=document.getElementById('hiddenTypeGeom').value;
      var urlEdit="Edit"
      var dato={
        _token : j('meta[name="csrf-token"]').attr('content'), 
        "geom":typeSelect.value,
        "titulo":titulo,
        "user_id":id,
        "idGeom":idGeom,
        "descripcion":descripcion,
        "nombreFoto":nombreFoto,//global seteada cuando se elije la foto es aleatoria segun se haya editado en la ventana de edicion
        "categoria":categoria,
        "TypeGeom":TypeGeom
      };
      if(titulo!=""){
        console.log("nombre d ela foto a subir "+nombreFoto);
        ajaxSubirImg2();
        ajaxRequest(dato,urlEdit);
        closePopup();
        var data = {message: 'Actualización realizada con exito '};
        snackbarContainer.MaterialSnackbar.showSnackbar(data);
        
      }else{
        document.getElementById("mensajeError").style.display="";
        document.getElementById("mensajeError").innerHTML="El campo Título no puede estar vacío";
        window.setTimeout(mensajeError, 3000);
      }
   
    });//fin aceptar datos info
    function mensajeError(){//funcion de espera y borrado del mensaje dentro del popup
       document.getElementById('mensajeError').style.display='none';
    }

    j(".aceptarDatos").click(function(){ //aceptar datos del popup de creacion de geom
        
        var titulo = document.getElementById('titulo').value;
        var descripcion=document.getElementById('descripcion').value;
        var categoria=document.getElementById('categoria').value;
        var nombre={!! auth()->user() !!};
        var id=nombre.id;

        var value = typeSelect.value;
        var x;
        var y;
        if(titulo!=""){//si el titulo no es vacio borro el objeto y cierro ventana, luego vuelvo al PAN

          var features = vector.getSource().getFeatures();
          features.forEach((feature) => {
                x=feature.N.geometry.A[0];
                y=feature.N.geometry.A[1];
                colPuntos=feature.N.geometry.A;
          });
          var dato={
            _token : j('meta[name="csrf-token"]').attr('content'), 
            "geom":typeSelect.value,
            "titulo":titulo,
            "user_id":id,
            "descripcion":descripcion,
            "nombreFoto":nombreFoto,//global seteada cuando se elije la foto o en primera instancia cuando arranca la app
            "categoria":categoria,
            "colPuntos":colPuntos,
            "x":x,
            "y":y
          };
          ajaxRequest(dato,value);//el value lleva implicita la direccion del request de ajax
          ajaxSubirImg();
         // console.log("avatar valor "+$avatarInput2[0].files[0].name);
          ///////////////////CREAR UNA VENTANA DE ESPERA///////////////////////////////////////////////////
         /* j.magnificPopup.open({
            items: [{
            src: '#espere',
            type: 'inline'}],
            modal:true,
            index: 2
          });*/

          map.removeInteraction(draw);
          addInteraction(value);
          document.getElementById('titulo').value="";
          document.getElementById('descripcion').value="";         
          document.querySelector('#titulo').parentNode.MaterialTextfield.change("");
          document.querySelector('#descripcion').parentNode.MaterialTextfield.change("");
              /*  document.querySelector('#categoria').parentNode.MaterialTextfield.change("Otros");*/
          var magnificPopup = j.magnificPopup.instance;
          magnificPopup.close();
         //no se borra el ultimo punto para que quede en la tesela
          map.removeInteraction(draw);
          addInteraction("None");  
          refreshCapa();

        }else{ //el titulo es vacio
          document.getElementById("mensajeError").style.display="";
          document.getElementById("mensajeError").innerHTML="El campo Título no puede estar vacío";
          window.setTimeout(mensajeError, 3000);
        }

      }); //fin aceptar datos
    j(".cerrarInfo").click(function(){
      closePopup();
      map.setTarget('map');
    });
   
    j(".zoom").click(function(){
      closePopup();
    });

    j(".categoriarr").change(function(){
      var cat=document.getElementById('categoriarr').value;
      document.querySelector('#categoria').parentNode.MaterialTextfield.change(cat);
       // map.getView().animate({center: coords, zoom: 10});
     
    });
    function refreshCapa(){
      var sourcePuntos = mapaPuntos.getSource();
      var sourceLineas=mapaLineas.getSource();
      map.removeLayer(sourcePuntos); 
      sourcePuntos.refresh({force: true});
      map.removeLayer(sourceLineas); 
      sourceLineas.refresh({force: true});
      map.updateSize();
    }
    j(".borrarGeomConfirmacion").click(function(){
      var idGeom=document.getElementById('hiddenIdGeom').value;
      var TypeGeom=document.getElementById('hiddenTypeGeom').value;
      var urlDelete="Delete"
      var dato={
        _token : j('meta[name="csrf-token"]').attr('content'), 
        "idGeom":idGeom,
        "nombreFoto":nombreFoto,//global seteada cuando se elije la foto
        "TypeGeom":TypeGeom
      };
      ajaxRequest(dato,urlDelete);
      closePopup();
      var data = {message: 'Geometria borrada con exito '};
      snackbarContainer.MaterialSnackbar.showSnackbar(data);
      refreshCapa();
    });
    j(".borrarGeomBD").click(function(){
      j.magnificPopup.open({
        items: [{
        src: '#geomAviso',
        type: 'inline'}],
        modal:true,
        index: 2
      });

  

    });
    j(".aceptarGeom").click(function(){ //ventana de eleccion de geometria, es importante notar que esto define el tipo de datos a agregar en el mapa mediante el agregado de la interaccion, tambien cierra la ventana de eleccion de geometria, es importante destacar que esta ventana NO llama a la ventana de carga de datos, esta se llama luego de un click en el mapa
        var data = {message: 'Elija una geometría'};
        var value = typeSelect.value;
        if(value!="" && value=="Point" || value=="LineString" || value=="Polygon"){
          //borro geometrias anteriores
          borrarGeoms();
          map.removeInteraction(draw);
          //agrego la nueva interaccion
          addInteraction(value);
          var magnificPopup = j.magnificPopup.instance;
          magnificPopup.close();
          $("#mySidenav").prop('disabled',true);
          $("spanMenu").css("pointer-events", "none");
          $("spanMenu").unbind("click");
          editando=true;
        }else{

          snackbarContainer.MaterialSnackbar.showSnackbar(data);

        }

      }); //fin aceptar geom
   
    function borrarGeoms(){ // se borra el vector dibujado
         var features = vector.getSource().getFeatures();
          features.forEach((feature) => {
            console.log(feature.N.geometry.A[0]);
            vector.getSource().removeFeature(feature);
            });
          map.removeInteraction(draw);
          addInteraction("None");
      }

    j(".cancelarGeom").click(function(){
        var magnificPopup = j.magnificPopup.instance;
        magnificPopup.close();
        borrarGeoms();
      });

    j(".btnAbout").click(function(){ //funcion que dispara el agregado de geometria
      j( "#dialog" ).dialog("open");
    }); 
    j(".btnAgregarObjeto").click(function(){ //funcion que dispara el agregado de geometria
      usoPuntero="navegando";
      j.magnificPopup.open({
        items: [{
          src: '#choseGeom',
          type: 'inline'}],
        modal:true,
        index: 2
      });

    }); //fin btnagregarobjeto

    j( "#open-hide" ).click(function() {
        j( this ).toggleClass( "show" );
    });

      ///////////////////capas inicio///////////////////////

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
      var mapaPuntos=new ol.layer.Tile({
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

      var typeSelect = document.getElementById('type');
      var draw; // global so we can remove it later
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

      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      function tomarCapa(fuente){
        var view = map.getView();
        var viewResolution = view.getResolution();
        var url=fuente.getGetFeatureInfoUrl(  
                coordenada, viewResolution, view.getProjection(),{'INFO_FORMAT': 'application/json'});
        return url;
      }
      function setNoIntersectPoint(){//llamo a esta funcion si no se intersecto un punto en consultarWMS
        consultarWMS("lineas")//llamo a consultarWMS pero con el tipo linea
      }
      function editarWMS(tipoGeom){
        j.magnificPopup.open({
              items: [{
              src: '#geomEdicion',
              type: 'inline'}],
              modal:true,
              index: 2
            });

      }
      /////////////////////////////////////////////
      function consultarWMS(tipoGeom)
      {
        var lineas=false;
        if(tipoGeom=="puntos"){
          fuente=mapaPuntos.getSource();
          console.log("son puntos");
        }else{
          fuente=mapaLineas.getSource();
          lineas=true;//si entro a este else entonces la consulta es sobre lineas
          console.log("son lineas");
        }
        
        var url=tomarCapa(fuente);
        var dato={
            _token : j('meta[name="csrf-token"]').attr('content'), 
            "url":url,
          };
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': j('meta[name="csrf-token"]').attr('content'),
            'Access-Control-Allow-Credentials' : true,
            'Access-Control-Allow-Origin':'*',
            'Access-Control-Allow-Methods':'GET',
            'Access-Control-Allow-Headers':'application/json',
          },
          type: 'POST',
          dataType: 'json',
          data:dato,

          url: './InfoPoint',
          success: function (data) {
           
            var dataReturn=JSON.parse(data['mensaje']);
            var totalFeatures=dataReturn.numberReturned;
            if (totalFeatures!=0){            
              var titulo=dataReturn.features[0].properties.titulo;
              var descripcion=dataReturn.features[0].properties.comentario;
              var categoria=dataReturn.features[0].properties.categoria;
              var foto=dataReturn.features[0].properties.foto;
              nombreFoto=foto; //seteo por si es la primera entrada, sino queda en default3 si almaceno la info
              console.log("nobre foto infopoint "+nombreFoto);
              var creationDate=dataReturn.features[0].properties.updated_at;
              geomType=dataReturn.features[0].geometry.type;
              var featureId=dataReturn.features[0].id; //me devuelve tabla.id, hay que separarlo
              separador = ".";
              var subCad = featureId.split(separador);
              var featureN=subCad[1]; //solo id de la feature
              featureIdN=featureN; //mando este valor a la global, sino tengo que usar una u otra variable segun venga la consulta de infopoint o de los enlaces que recupera el feature id de una manera diferente, sin el punto separador
              var usuarioLoged={!!json_encode(Auth::user()->id)!!};
             // console.log("nombre de la foto en la bd "+nombreFoto);
              usuario=dataReturn.features[0].properties.user_id;

              if (foto!=sinFoto){//foto de la base de datos si hay foto
                var urlFoto={!!json_encode(asset('images/users/'))!!}+"/"+foto+"?timestamp=" + new Date().getTime(); //el time stamp es para refrescar el cache, sino carga siempre la ultima imagen
              }else{
                var urlFoto={!!json_encode(asset('images/users/'))!!}+"/"+sinFoto;//+"?timestamp=" + new Date().getTime();;
                console.log("es igual a sin foto");
              }
              if (usuario==usuarioLoged){ //el consultante tiene pertenencia sobre la geometria,entonces puede editarla
                var editable="Editable"
                j.magnificPopup.open({
                  items: [{
                  src: '#geomEdicion',
                  type: 'inline'}],
                  modal:true,
                  index: 2
                });

                document.querySelector('#titulo').parentNode.MaterialTextfield.change(titulo);
                document.querySelector('#descripcion').parentNode.MaterialTextfield.change(descripcion);
                document.getElementById('categoria').value=categoria;
                document.getElementById('hiddenIdGeom').value = featureN;
                document.getElementById('hiddenTypeGeom').value = geomType;
                document.getElementById('datosUsuario').innerHTML =  "#usuario: "+usuario+" | "+"Creación: "+creationDate+" | "+"Tipo: "+geomType+" | "+"#idGeom: "+featureN+" | "+editable;
                $avatarImageInfo.attr('src', urlFoto); //actualizo la foto en el popup de info
              }else{
                var editable="No editable"
                j.magnificPopup.open({
                  items: [{
                  src: '#geomInfo',
                  type: 'inline'}],
                  modal:true,
                  index: 2
                });
                document.getElementById('nodelist').innerHTML =  titulo;
                document.getElementById('infoDescripcion').innerHTML =  descripcion;
                document.getElementById('infoCategoria').innerHTML =  categoria;
                document.getElementById('datosUsuario').innerHTML =  "#usuario: "+usuario+" | "+"Creación: "+creationDate+" | "+"Tipo: "+geomType+" | "+"#idGeom: "+featureN+" | "+editable;
                $infoImage.attr('src', urlFoto);
              }

            }else if(lineas!=true){
              setNoIntersectPoint();

            }else{
              var mensaje= {message: 'No se intersectó geometria'};
              snackbarContainer.MaterialSnackbar.showSnackbar(mensaje);
            }

            },
           
          });

      } //fin consultar wms

      map.on('singleclick', function(evt) {
        coordenada = evt.coordinate;
        console.log(coordenada);
        var view = map.getView();
        fuente=mapaPuntos.getSource();
        var viewResolution = view.getResolution();
        var url=fuente.getGetFeatureInfoUrl(  
                coordenada, viewResolution, view.getProjection(),{'INFO_FORMAT': 'application/json'}); 

        switch(usoPuntero) {
        case "navegando":
          console.log("navegando");
        break;
        case "informando":
        console.log("informando");
          consultarWMS("puntos");
          map.getView().animate({center: coordenada, zoom: 15});
          usoPuntero="navegando";
          
        break;
        case "editando":
          nombreFoto=sinFoto;//en la primera entrada pongo esta global por defecto (se cambia una vez que se hace click en el enlace de la foto del popup)
          console.log("editando");
          editarWMS("puntos");
          map.getView().animate({center: coordenada, zoom: 15});
          usoPuntero="navegando";
         break
        }        
        
      });
      //var puntero=typeSelect.value;
     
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
              index: 1
            });
            $("#avatarImage2").attr("src", {!!json_encode(asset('images/users/'))!!}+"/"+sinFoto); //esto es para impedir que quede la misma imagen si edito un punto, cargo una imagen y cancelo
            nombreFoto=sinFoto;//seteo la foto por defecto en la edicion
            editando=false;//para que no se pueda actuar con el menu si se dio la creacion de punto, recien se sale luego del click, eso es para que no se confundan las acciones de info y creaciond e geom

          });

        }
      }
///////////cfkfdkdkfdkfdkfkfdagregar el codigo onchange!!!!!!!!!!!!!!!!!
      /**
       * Handle change event.
       */
      typeSelect.onchange = function() {
        var value = typeSelect.value;
        map.removeInteraction(draw);
        addInteraction(value);
      };

      addInteraction('None');

     
        j('.envio').click(function(){
     

        });
    });
    
    </script>

@endsection
