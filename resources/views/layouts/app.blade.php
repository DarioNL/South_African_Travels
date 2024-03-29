<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->




<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    South African Travels
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <a class="nav-item nav-link" href="/home">Home</a>
                        @auth('admin')
                            <a class="nav-item nav-link" href="/admin/landen">Landen</a>
                        <a class="nav-item nav-link" href="/admin/bestemmingen">Bestemmingen</a>
                        @endauth
                        <a class="nav-item nav-link" href="/reizen">Reizen</a>
                        @auth('admin')
                        <a class="nav-item nav-link" href="/boekingen">Boekingen</a>
                        @elseauth('web')
                            <a class="nav-item nav-link" href="/boekingen">Boekingen</a>
                        @else

                        @endauth
                        <!-- Authentication Links -->

                        @auth('web')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Illuminate\Support\Facades\Auth::user()->first_name}} {{Illuminate\Support\Facades\Auth::user()->last_name}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @elseauth('admin')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{Illuminate\Support\Facades\Auth::guard('admin')->user()->first_name}} {{Illuminate\Support\Facades\Auth::guard('admin')->user()->last_name}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @php($action = substr((Illuminate\Support\Facades\Route::currentRouteAction()), strpos(Illuminate\Support\Facades\Route::currentRouteAction(), "@") ))
        <footer @if($action != '@show' or Illuminate\Support\Facades\Route::currentRouteAction() == 'App\Http\Controllers\CountriesController@show' ) @if($action == '@showRegistrationForm') @else style="position: absolute" @endif @endif class=" text-center border-top   text-lg-start">

            <div class="page-container p-4">

                <div class="content-wrap"></div>

                <div class="row">

                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase text-white">South African Travels</h5>

                        <p class="text-light">
                            South African travels is een reisbureau, dat gespecialiseerd is in luxe reizen naar Zuid-Afrika. Het bedrijf heeft zijn succes vooral te danken aan een persoonlijke aanpak en aan de kennis die zij hebben van de mogelijkheden van reizen binnen Zuid-Afrika.
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase text-white mb-0">pagina's</h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#!" class="text-dark">Home</a>
                            </li>
                            @auth('admin')
                                <li>
                                    <a href="admin/landen" class="text-dark">landen</a>
                                </li>
                            <li>
                                <a href="admin/bestemmingen" class="text-dark">bestemmingen</a>
                            </li>
                            <li>
                                <a href="/boekingen"></a>
                            </li>
                            @elseauth('web')
                                <li>
                                    <a href="/boekingen"></a>
                                </li>
                            @else

                            @endauth
                            <li>
                                <a href="/reizen" class="text-dark">Reizen</a>
                            </li>
                            @auth('web')
                            @elseauth('admin')
                            @else
                                <li>
                                    <a href="#!" class="text-dark">Login</a>
                                </li>

                                <li>
                                    <a href="#!" class="text-dark">Register</a>
                                </li>
                            @endauth
                        </ul>
                    </div>

                </div>

            </div>



            <div class="text-center navbar-light p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © {{\Carbon\Carbon::now()->year}} Copyright:
                <a class="text-light">South African Travels</a>
            </div>

        </footer>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    @yield('javascripts')
</body>
</html>
