<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') @if (trim($__env->yieldContent('title')))-@endif {{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
        
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <style>
            @import url('https://fonts.googleapis.com/css?family=Inconsolata:700');

            /*.search-wrapper {
                position: absolute;
                margin: auto;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 300px;
                height: 100px;
            }*/
            .search {
                position: absolute;
                margin: auto;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                width: 40px;
                height: 40px;
                background: crimson;
                border-radius: 50%;
                transition: all 1s;
                z-index: 4;
                /*box-shadow: 0 0 25px 0 rgba(0, 0, 0, 0.4);*/
                /*// box-shadow: 0 0 25px 0 crimson;*/
            }
            .search:hover {
                cursor: pointer;
            }
            .search::before {
                content: "";
                position: absolute;
                margin: auto;
                top: 13px;
                right: 0;
                bottom: 0;
                left: 15px;
                width: 10px;
                height: 2px;
                background: white;
                transform: rotate(45deg);
                transition: all .5s;
            }
            .search::after {
                content: "";
                position: absolute;
                margin: auto;
                top: -5px;
                right: 0;
                bottom: 0;
                left: -5px;
                width: 18px;
                height: 18px;
                border-radius: 50%;
                border: 2px solid white;
                transition: all .5s;
            }
              
            input {
                font-family: 'Inconsolata', monospace;
                position: absolute;
                margin: auto;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                width: 30px;
                height: 30px;
                outline: none;
                border: none;
                /*// border-bottom: 1px solid rgba(255, 255, 255, 0.2);*/
                background: crimson;
                color: white;
                text-shadow: 0 0 10px crimson;
                /*padding: 0 80px 0 20px;*/
                border-radius: 30px;
                /*box-shadow: 0 0 25px 0 crimson,*/
                            /*0 20px 25px 0 rgba(0, 0, 0, 0.2);*/
                /*// box-shadow: inset 0 0 25px 0 rgba(0, 0, 0, 0.5);*/
                transition: all 1s;
                /*opacity: 0;*/
                /*visibility: hidden;*/
                background-color: transparent;
                z-index: 5;
                font-weight: bolder;
                letter-spacing: 0.1em;
            }
            input:hover {
                cursor: pointer;
            }
            input:focus {
                width: 300px;
                opacity: 1;
                cursor: text;
                padding: 0 80px 0 20px;
                background: crimson;
            }
            input:focus ~ .search {
                right: -250px;
                background: #151515;
                z-index: 6;
            }
            input:focus::placeholder {
                opacity: .5;
            }
            input::before {
                top: 0;
                left: 0;
                width: 25px;
            }
            input::after {
                top: 0;
                left: 0;
                width: 25px;
                height: 2px;
                border: none;
                background: white;
                border-radius: 0%;
                transform: rotate(-45deg);
            }
                
            input::placeholder {
                color: white;
                opacity: 0;
                font-weight: bolder;
            }
        </style>

    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            @auth
                            <li class="nav-item"><a class="nav-link" href="#">Link1</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Link2</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Link3</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Link4</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Link5</a></li>
                            @endauth
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
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

            <main class="py-4">
                @yield('content')
            </main>
        </div>

         <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" ></script>

        <!-- App scripts -->
        @stack('scripts')
    </body>
</html>
