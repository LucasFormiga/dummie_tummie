<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dummie Tummie') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if(!Auth::guest())
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">Usuários</a>
                            </li>
                        </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }} <span class="caret"></span>
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
            @if (session('message'))
                <div class="alert alert-{{ session('message')['class'] ?? 'success' }} text-center" style="border-radius: 0">
                    <div class="container-fluid">
                        {{{ session('message')['content'] }}}
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
