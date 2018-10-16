<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | Welcome</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    </head>

    <body class="text-center">

        <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                    <h3 class="masthead-brand">{{ config('app.name', 'Laravel') }}</h3>

                    <nav class="nav nav-masthead justify-content-center">

                        <ul class="navbar-nav ml-auto mr-3">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    {{ Config::get('languages')[App::getLocale()] }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach (Config::get('languages') as $lang => $language)
                                        @if ($lang != App::getLocale())
                                            <li class="dropdown-item">
                                                <a href="{{ route('lang.switch', $lang) }}" class="text-black-50">{{$language}}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        </ul>

                        @if (Route::has('login'))
                            @auth
                                <a class="nav-link active" href="{{ url('/home') }}">{{ __('Home') }}</a>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endauth
                        @endif
                    </nav>
                </div>
            </header>

            <main role="main" class="inner cover">
                <h1 class="cover-heading">Project</h1>
                <p class="lead">{!! __('welcome.welcome_text') !!}</p>
                <p class="lead">
                    <a href="{{ route('register') }}" class="btn btn-lg btn-secondary">{{ __('Register') }}</a>
                </p>
            </main>

            <footer class="mastfoot mt-auto">
                <div class="inner">
                    <p>Project - {{ date('Y') }}</p>
                </div>
            </footer>
        </div>
    </body>
</html>
