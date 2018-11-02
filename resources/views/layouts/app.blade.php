<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

     <title>{{ config('app.name', 'GeoLoc') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
   
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <!-- Magnific Popup core CSS file -->
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/cssol4/ol.css') }}" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type='text/css' href="{{URL::asset('css/magnific-popup2.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/style3.css') }}" type='text/css'>
    <link rel="stylesheet" href="{{URL::asset('css/material.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/getmdl-select.min.css') }}">
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('js/ol4/ol.js')}}"></script>
    <script src="{{URL::asset('js/script.js')}}"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.magnific-popup.js')}}"></script>
    <script src="{{URL::asset('js/material.min.js')}}"></script>
    <script defer src="{{URL::asset('js/getmdl-select.min.js')}}"></script>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="{{URL::asset('js/remodal.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="{{URL::asset('css/estilo_prop.css') }}" type="text/css">
</head>
<body >

</div>
    <div id="app" >
        
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container" >
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'GeoLoc') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @guest
                
                @else
                    <span style="font-size:15px;cursor:pointer;margin-left: 20px" id="spanMenu" onclick="openNav()">Menu </span>
                @endguest
<!--icono menu &#9776;-->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Ingreso') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                            </li>
                           
                        @else
                            <li class="nav-item dropdown">

                            
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="avatar" src="{{ Auth::user()->avatar }}" alt="" onerror=this.src="{{ asset('images/users/Portrait_Placeholder.png') }}" >  {{ Auth::user()->name }} <span class="caret"> </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" >
            @yield('content')
            @yield('view.scripts')
        </main>
       
    </div>

<div class="panel-footer"> &nbsp © MMXVIII Derechos Reservados - Santiago Castellano</div>
</body>

</html>
