<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('title')

    <link rel="stylesheet" href="{{ asset('lib/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('lib/css/superslides.css')}}">
    <link href="{{ asset('lib/fontawesome-free-5.12.0-web/css/all.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/slick/slick.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/slick/slick-theme.css')}}" />
    <!-- <link href="https://vjs.zencdn.net/7.6.6/video-js.css" rel="stylesheet" /> -->

    <!-- including custom Style -->
    @yield('pageSpecificStylesheet')



    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('lib/js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/slick-1.8.1/slick/slick.min.js')}}" defer></script>

    <!-- including script -->
    @yield('pageSpecificScript')

</head>
<?php
if (!isset($page)) {
    $page = "";
}
?>

<body class="pb-5">

    <!------------------- Home Page Loading Overlay ---------------->

    <div class="bg-light loading-overlay" style="position: fixed; top:0px; left:0px; z-index:90101; width:100vw; height:100vh;">
        <div class="spinner-border " role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!------------------- /Home Page Loading Overlay ---------------->

    <div class="container-fluid bt-nav-container bt-navbar" id="navbar">
        <div class="row  m-0">
            <div class="col-lg-12 justify-content-center col-md-10">
                <nav class="navbar navbar-expand-lg navbar-light py-0">
                    <a class="navbar-brand mr-1 pr-2" href="{{ url('/') }}" style="border-right: 2px solid white;">
                        <i class="fas fa-assistive-listening-systems"></i>
                        BlueTube
                    </a>
                    <button class="navbar-toggler p-0 px-1" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item @if( $page == 'home' ) {{ 'active' }} @endif">
                                <a class="nav-link" href="{{ url('/') }}">
                                    <i class="fas fa-home"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item @if( $page == 'movies' ) {{ 'active' }} @endif">
                                <a class="nav-link" href="{{ route('movies') }}">
                                    <i class="fas fa-film"></i>
                                    Movie
                                </a>
                            </li>
                            <li class="nav-item @if( $page == 'tv' ) {{ 'active' }} @endif">
                                <a class="nav-link " href="{{ route('tv') }}" tabindex="-1" aria-disabled="true">
                                    <i class="fas fa-tv"></i>
                                    Clip
                                </a>
                            </li>
                            <li class="nav-item @if( $page == 'natok' ) {{ 'active' }} @endif">
                                <a class="nav-link " href="{{ route('natok') }}" tabindex="-1" aria-disabled="true">
                                    <i class="fas fa-futbol"></i>
                                    Natok
                                </a>
                            </li>
                        </ul>
                        <div class="row mr-3">
                            <div class="col-lg-12">
                                <form class="form-inline m-0 p-0 w-100" method="get" action="{{ route('search', ['type'=>'any']) }}" style="min-width: 206px;">
                                    <input class="form-control" type="search" placeholder="Search" name="q" style="width:auto; min-width:100px;max-width:170px;">
                                    <input type="hidden" name="type" value="title">
                                    <button class="btn btn-success py-0 my-2 my-sm-0 search-button" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="row search-row">
                            @if( !Auth::check() )
                            <div class="col-lg-12 pr-0" style="min-width:200px">
                                <a href="{{ route('login') }}" class="btn btn-success btn-sm" style="padding:2.5px 15px;">Log In</a>
                                <a href="{{ route('register') }}" class="btn btn-success btn-sm" style="padding:2.5px 15px;">Sign Up</a>
                            </div>
                            @else
                            <div class="col-lg-12 pr-0" style="min-width:200px">
                                <div class="dropdown show" style="position:relative; z-index:10101">
                                    <!-- if have Notification -->
                                    @if( 1==0 )
                                    <a href="{{ route('notification') }}" class="notification">
                                        @php
                                        echo rand(1,99)
                                        @endphp
                                    </a>
                                    @endif
                                    <a class="btn btn-sm pl-3 py-0 dropdown-toggle profile-btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu py-0" aria-labelledby="dropdownMenuLink">

                                        <a href="{{ route('profile') }}" class=" dropdown-item">

                                            @if( Auth::user()->profilepic )
                                            <img src="{{ URL(Auth::user()->profilepic) }}" class="profile-pic" alt="" style="width: 25px;height: 25px;border-radius: 50%;margin-left: -4px;">
                                            @else
                                            <i class="fas fa-user-circle profile-pic" style="width: 25px;height: 25px;border-radius: 50%;margin-left: -4px;"></i>
                                            @endif

                                            Profile
                                        </a>
                                        @can('viewAny',App\User::class)
                                        <a href="{{ route('dashboard') }}" class=" dropdown-item">
                                            <i class="fas fa-tachometer-alt mr-1"></i>
                                            Dashboard
                                        </a>
                                        @endcan
                                        <a href="{{ route('logout') }}" class=" dropdown-item">
                                            <i class="fas fa-sign-out-alt mr-1"></i>
                                            Logout
                                        </a>

                                        <!-- <a href="{{ route('logout') }}" class="btn btn-success btn-sm rounded" style="padding:2.5px 15px;">Log Out</a> -->
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- ---------------------/navbar---------------------- -->

    @yield('section')

    <div id="goToTopButton" class="p-2 px-3 text-light bg-success hide" onclick="scrollToTop(this)" title="Go To Top">
        <i class="fas fa-eject"></i>
    </div>


</body>

</html>
