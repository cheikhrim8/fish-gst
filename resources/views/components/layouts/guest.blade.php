<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('page-title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}">
        <link href="{{ URL::asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('vendor/fontawesome-free/css/brands.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('vendor/fontawesome-free/css/solid.min.css') }}" rel="stylesheet" type="text/css">
        <!-- Jquery-ui CSS -->
        <link href="{{ URL::asset('vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="{{ URL::asset('vendor/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
        <!-- DataTables Responsive CSS -->
        <link href="{{ URL::asset('vendor/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
        <!-- font-awesome -->
        <link href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- bootstrap-slider -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.min.css" integrity="sha512-3q8fi8M0VS+X/3n64Ndpp6Bit7oXSiyCnzmlx6IDBLGlY5euFySyJ46RUlqIVs0DPCGOypqP8IRk/EyPvU28mQ==" crossorigin="anonymous" />
        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/main2.css') }}">
        @livewireStyles

        <!-- Scripts -->
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
        @livewireScripts
    </head>
    <body>
        <nav id="main-menu" class="navbar navbar-expand-lg navbar-light bg-white">
          <div class="container">
            <a class="navbar-brand" href="{{url('/')}}"><img src='<?php  echo url("img/logo-dcsapp.png"); ?>'></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="{{url('/')}}">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    DCSApp
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('thenextpage')}}">DCSApp</a>
                    <a class="dropdown-item" href="{{url('thenextpage')}}">Qui somme-nous?</a>
                  </div>
                </li>
                @if(Auth::user())
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="logoutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{ Auth::user()->name }}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ url('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Tableau de bord
                    </a>
                    <a class="dropdown-item" href="{{ url('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i> Déconnecter
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </div>
                </li>
                @else
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/login')}}">Se connecter </a>
                </li>
                @endif
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <a href="{{route('nouvelle-annonce')}}" class="btn btn-annonce my-2 my-sm-0"> <i class="fa fa-plus fa-fw"></i> Déposer une annonce</a>
              </form>
            </div>
          </div>
        </nav>

        <div id="page-wrapper">
            @yield('page-content')
        </div>

        <div id="stagiaire-modal" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header-body">
              </div>
            </div>
          </div>
        </div>

        <footer id="main-footer" class="border-top bg-footer">
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-5">
                <img src="{{url('/img/logo-dcsapp.png')}}" class="float-left logo-footer mr-3">
                <div class=" align-self-center pt-3">
                  <span class="text-white-50 font-weight-bold">DCSApp</span><br>
                  <span class="text-white-50">APP MOBILE NUMERO 1 EN MAURITANIE </span>
                </div>
              </div>
              <div class="col-6 col-md">
                <h6 class="text-white">LIENS</h6>
                <ul class="list-unstyled text-small">
                  <li><a class="text-white-50" href="{{url('thenextpage')}}">Déposer une annonce</a></li>
                  <li><a class="text-white-50" href="{{url('thenextpage')}}">Consulter les annones</a></li>
                  <li><a class="text-white-50" href="{{url('thenextpage')}}">Offres</a></li>
                  <li><a class="text-white-50" href="{{url('thenextpage')}}">Demandes</a></li>
                </ul>
              </div>
              <div class="col-6 col-md">
                <h6 class="text-white">DCSAPP</h6>
                <ul class="list-unstyled text-small">
                  <li><a class="text-white-50" href="{{url('thenextpage')}}">A propos de nous</a></li>
                  <li><a class="text-white-50" href="{{url('thenextpage')}}">Contactez-nous</a></li>
                </ul>
              </div>
              <div class="col-6 col-md text-right">
                <h6 class="text-white">SUIVEZ-NOUS</h6>
                <div class="social-links">
                  <a href="#" target="_blank"><i class="fa fa-fw fa-facebook text-white"></i></a>
                  <a href="#" target="_blank"><i class="fa fa-fw fa-linkedin text-white"></i></a>
                  <a href="#" target="_blank"><i class="fa fa-fw fa-twitter text-white"></i></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col border-top border-dark pt-3 pb-3">
                <small class="d-block text-light">
                  &copy; DCSApp 2020 | Tous droits réservés
                  <span class="float-right">Designed By <a href="https://dcs-sarl.com" class="text-white" target="_blank">DCS Sarl</a></span>
                </small>
              </div>
            </div>
          </div>
        </footer>

        <script type="text/javascript">
          var racine = '{{url('/')}}/';
        </script>
        <!-- JQuery JS -->
        <script src="{{ URL::asset('vendor/jquery/jquery-3.4.1.min.js') }}"></script>
        <!-- Popper JS -->
        <script src="{{ URL::asset('vendor/popper/popper.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- bootstrap-slider -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js" integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA==" crossorigin="anonymous"></script>

        @yield('page-script')
    </body>
</html>
