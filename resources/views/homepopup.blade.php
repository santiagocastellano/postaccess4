<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

     <title>{{ config('app.name', 'GeoLoc') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   

 
   <!--<script src="http://localhost:8085/ol3/dist/ol-debug.js" type="text/javascript"></script>-->

    <!-- Fonts -->
   
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <!-- Magnific Popup core CSS file -->
    
    <!-- Styles -->
    <!--<link rel="stylesheet" href="http://localhost:8085/mapa/ol3/dist/ol.css" type="text/css">-->
    <!--<link rel="stylesheet" href="{{ asset('css/ol.css') }}" type="text/css">-->
    <link rel="stylesheet" href="{{ asset('css/cssol4/ol.css') }}" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type='text/css' href="{{URL::asset('css/magnific-popup2.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/style3.css') }}" type='text/css'>
    <link rel="stylesheet" href="{{URL::asset('css/material.min.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/getmdl-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/remodal.css') }}">
<link rel="stylesheet" href="{{ asset('css/remodal-default-theme.css') }}">
    <!--<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">-->
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!--<script src="http://openlayers.org/en/latest/build/ol.js" type="text/javascript"></script>-->
   <!-- <script type="text/javascript" src="{{URL::asset('js/openlayers/OpenLayers.js')}}"></script>-->
   <!--<script type="text/javascript" src="{{URL::asset('js/openlayers/ol-debug.js')}}"></script>-->
    <script type="text/javascript" src="{{URL::asset('js/ol4/ol.js')}}"></script>
    <script src="{{URL::asset('js/script.js')}}"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.magnific-popup.js')}}"></script>
    <!--<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>-->
    <script src="{{URL::asset('js/material.min.js')}}"></script>
    <script defer src="{{URL::asset('js/getmdl-select.min.js')}}"></script>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="{{URL::asset('js/remodal.min.js')}}"></script>
<style type="text/css">
    


/* text-based popup styling */
.white-popup {
  position: relative;
  background: #FFF;
  padding: 25px;
  width:auto;
  max-width: 400px;
  margin: 0 auto; 
}

.white-popup header{
  border-bottom:1px dotted #ccc;
  padding-bottom:.4em;
  margin-bottom:.4em;
}
.popup-scroll{
  /* Overflow Scroll */
  overflow-y: scroll;
  max-height: 300px;
  padding:0 1em 0 0;
}

/* custom scrollbars - webkit only */
.popup-scroll::-webkit-scrollbar {background-color:#EEE;width:10px;}
.popup-scroll::-webkit-scrollbar-thumb {
    border:1px #EEE solid;border-radius:2px;background:#777;
    -webkit-box-shadow: 0 0 8px #555 inset;box-shadow: 0 0 8px #555 inset;
    -webkit-transition: all .3s ease-out;transition: all .3s ease-out;
    }
.popup-scroll::-webkit-scrollbar-track {-webkit-box-shadow: 0 0 2px #ccc;box-shadow: 0 0 2px #ccc;} 




</style>


</head>
<body >

<h3>Scrolling Popup Demo</h3>
<div class="links">
  <ul id="inline-popups">
    <li><a href="#test-popup" data-effect="mfp-zoom-in">Trigger Popup</a></li>
  </ul>

<!-- Popup itself -->
<div id="test-popup" class="white-popup mfp-with-anim mfp-hide">
  <header>Popup Header</header>
  <div class="popup-scroll">
  <p>F, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>

<p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>

<p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>

<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy.</p>

<p>The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again.</p>

<p>And if she hasn’t been rewritten, then they are still using her. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>

<p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way. When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline</p>
  </div>

  </div>
<script type="text/javascript">
// Inline popups
$('#inline-popups').magnificPopup({
  delegate: 'a',
  removalDelay: 500, //delay removal by X to allow out-animation
  callbacks: {
    beforeOpen: function() {
       this.st.mainClass = this.st.el.attr('data-effect');
    }
  },
  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
});


// Image popups
$('#image-popups').magnificPopup({
  delegate: 'a',
  type: 'image',
  removalDelay: 500, //delay removal by X to allow out-animation
  callbacks: {
    beforeOpen: function() {
      // just a hack that adds mfp-anim class to markup 
       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
       this.st.mainClass = this.st.el.attr('data-effect');
    }
  },
  closeOnContentClick: true,
  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
});


// Hinge effect popup
$('a.hinge').magnificPopup({
  mainClass: 'mfp-with-fade',
  removalDelay: 1000, //delay removal by X to allow out-animation
  callbacks: {
    beforeClose: function() {
        this.content.addClass('hinge');
    }, 
    close: function() {
        this.content.removeClass('hinge'); 
    }
  },
  midClick: true
});    



</script>

</body>

</html>