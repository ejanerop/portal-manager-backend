<!doctype html>
<html lang="en">
  <head>
    <title>Cerrar sesión</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700, 900|Vollkorn:400i" rel="stylesheet"-->
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" id="home-section">


  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar js-sticky-header site-navbar-target" role="banner" >

      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a class="h2 mb-0">Logout<span class="text-primary">.</span></a></h1>
          </div>

          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">



              <!-- Boton Portal de juegos -->

                @if (\Portals::isGamerUser($_SERVER['REMOTE_ADDR']))
                <!--Portal Games-->
                    <li class="has-children">
                        <a href="#about-section" class="nav-link">Juegos <i class="fa fa-gamepad fa-spin"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('closeSession', ['portal' => 'games']) }}" class="nav-link">Cerrar sesión</a></li>
                            <li><a href="{{ route('changePortal', ['portal' => 'games']) }}" class="nav-link">Cambiar a portal</a></li>
                        </ul>
                    </li>

                    <li class="has-children">
                        <a href="#about-section" class="nav-link">Descarga <i class="fa fa-download"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('closeSession', ['portal' => 'download']) }}" class="nav-link">Cerrar sesión</a></li>
                            <li><a href="{{ route('changePortal', ['portal' => 'download']) }}" class="nav-link">Cambiar a portal</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="{{ route('logs') }}" class="nav-link">Logs <i class="fa fa-address-card fa-spin"></i></a></li>

                @endif



            <!-- Botones AleCell -->


        <!--    @if (\Portals::isSpecialUser($_SERVER['REMOTE_ADDR']))
                    <li class="has-children">
                        <a href="#about-section" class="nav-link">Nacional <i class="fa fa-download"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('closeSpecial', ['portal' => 'national']) }}" class="nav-link">Cerrar sesión</a></li>
                            <li><a href="{{ route('changeSpecial', ['portal' => 'national']) }}" class="nav-link">Cambiar a portal</a></li>
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#about-section" class="nav-link">Internacional <i class="fa fa-download"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('closeSpecial', ['portal' => 'international']) }}" class="nav-link">Cerrar sesión</a></li>
                            <li><a href="{{ route('changeSpecial', ['portal' => 'international']) }}" class="nav-link">Cambiar a portal</a></li>
                        </ul>
                    </li>
                @endif   -->



                <!-- Botones Navajo -->

                
        <!--   @if (\Portals::isSpecialUser2($_SERVER['REMOTE_ADDR']))
                    <li class="has-children">
                        <a href="#about-section" class="nav-link">Opciones! <i class="fa fa-gamepad"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('changeSpecial', ['portal' => 'portal1']) }}" class="nav-link">Cambiar a portal 1</a></li>
                            <li><a href="{{ route('changeSpecial', ['portal' => 'portal2']) }}" class="nav-link">Cambiar a portal 2</a></li>
                            <li><a href="{{ route('closeSpecial', ['portal' => 'portal1']) }}" class="nav-link">Cerrar cuenta!</a></li>
                        </ul>
                    </li>
                @endif   -->



                <!-- Botones VPN -->


                @if (\Portals::isVPNuser($_SERVER['REMOTE_ADDR']))
                    <li class="has-children">
                        <a href="#about-section" class="nav-link">VPN service</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('enableScript') }}" class="nav-link">Enable VPN</a></li>
                            <li><a href="{{ route('disableScript') }}" class="nav-link">Disable VPN,Disconnect account</a></li>
                        </ul>
                    </li>
                @endif


                <!-- Botones Erick -->


                @if (\Portals::isEric($_SERVER['REMOTE_ADDR']))
                    <li class="has-children">
                        <a href="#about-section" class="nav-link">Portales</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('closeEric') }}" class="nav-link">Cerrar free</a></li>
                            <li><a href="{{ route('changeEric', ['portal' => 'free']) }}" class="nav-link">Cambiar a free</a></li>
                            <li><a href="{{ route('changeEric', ['portal' => 'gamer']) }}" class="nav-link">Cambiar a games</a></li>
                        </ul>
                    </li>
                @endif


                <!-- Botones Mandy -->


                @if ($_SERVER['REMOTE_ADDR'] == '192.168.20.56')
                <li class="has-children">
                        <a href="#about-section" class="nav-link">Portales especiales <i class="fa fa-star"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('closeVerySpecial', ['portal' => '1']) }}" class="nav-link">Cerrar 1</a></li>
                            <li><a href="{{ route('closeVerySpecial', ['portal' => '2']) }}" class="nav-link">Cerrar 2</a></li>                            
                            <li><a href="{{ route('closeVerySpecial', ['portal' => '3']) }}" class="nav-link">Cerrar 3</a></li>
                            <li><a href="{{ route('closeVerySpecial', ['portal' => '4']) }}" class="nav-link">Cerrar 4</a></li>
                        </ul>
                </li>
                @endif


                <!-- Botones Mandy -->


                @if ($_SERVER['REMOTE_ADDR'] == '192.168.20.86')
                <li class="has-children">
                        <a href="#about-section" class="nav-link">Portales especiales <i class="fa fa-star"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('closeVerySpecial', ['portal' => '3']) }}" class="nav-link">Cerrar 3</a></li>
                        </ul>
                </li>
                @endif


                <!-- Botones Vengador -->


                @if (\Portals::isAvenger($_SERVER['REMOTE_ADDR']))
                <!--Script para poner cuenta!-->
                    <li class="has-children">
                        <a href="#about-section" class="nav-link">Scripts <i class="fa fa-gamepad"></i></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('toggleScript', ['active' => true]) }}" class="nav-link">Activar Script</a></li>
                            <li><a href="{{ route('toggleScript', ['active' => false]) }}" class="nav-link">Desactivar Script</a></li>                            
                            <li><a href="{{ route('changeAvenger') }}" class="nav-link">PortalnewVergaCorta</a></li>
                        </ul>
                    </li>
                @endif


                <!-- Botones Flasho -->

                
                @if (\Portals::isFlasho($_SERVER['REMOTE_ADDR']))
                    <li class="has-children">
                        <a href="#about-section" class="nav-link">For my friends! <i class="fa fa-download"></i></a>
                        <ul class="dropdown">                        
                            <li><a href="{{ route('changeFlasho') }}" class="nav-link">Change portal!</a></li>
                            <li><a href="{{ route('closeFlasho') }}" class="nav-link">Close portal!</a></li>
                        </ul>
                    </li>
                @endif


              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>

    </header>




    <section class="site-blocks-cover overflow-hidden bg-light">

        <div class="container">
            <div class="row">
                <div class="col-md-7 align-self-center text-center text-md-left">
                    <div class="intro-text">
                        <h1>Portal <span class="d-md-block"></span></h1>


                    <!--Boton General-->


                        @if (!\Portals::isGamerUser($_SERVER['REMOTE_ADDR']))
                        <p class="mb-4"><a href="{{ route('logout') }}" class="btn btn-primary">Cerrar sesión</a><span class="d-block"></p>
                        @endif


                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        @if(session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa fa-spinner fa-spin"></i>
                            {{session('error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                    </div>
                </div>
                <div class="col-md-5 align-self-end text-center text-md-right">
                    <img src="{{ asset('images/dogger_img_1.png') }}" alt="Image" class="img-fluid cover-img">
                </div>
            </div>

        </div>
    </section>

  </div> <!-- .site-wrap -->



  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/jquery-ui.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('js/jquery.sticky.js') }}"></script>
  <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('fontawesome/js/all.js') }}"></script>


  <script src="{{ asset('js/main.js') }}"></script>


  </body>
</html>
