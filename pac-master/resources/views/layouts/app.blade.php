<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="theme-light bg-black" style="margin: 0 auto 20px;    width: 960px;   padding: 0 0 20px;">
    <div id="app" class="bg-page">
        <nav class="bg-header section">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-1">
                    <h1>
                        <a class="navbar-brand text-muted text-base font-light text-center" >    THE PEOPLE'S <br/> ARCHIVE OF COSTUME</a>
                    </h1>
                    <div id="menu">
                        <ul id="nav_links" class="list-style-type-none flex justify-between items-center" style="list-style-type:none;">
                            <li class="py-4 px-4">
                                <a href="{{ url('/') }}">HOME</a>
                            </li>
                            <li class="py-4 px-4">
                                <a href="">ABOUT</a>
                            </li>
                            <li class="py-4 px-4">
                                <a href="{{ url('article') }}">BROWSE</a>
                            </li>
                            <li class="py-4 px-4">
                                <a href="/article/create">ADD GARMENT</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <!-- Right Side Of Navbar -->
                        <div class="flex items-center ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <a class="text-accent mr-4 no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>

                                @if (Route::has('register'))
                                    <a class="text-accent no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
{{--                                <theme-switcher></theme-switcher>--}}
                                <dropdown align="right" width="200px">
                                    <template v-slot:trigger>
                                        <button
                                            class="flex items-center text-default no-underline text-sm focus:outline-none"
                                            v-pre
                                        >
                                            <img width="35"
                                                 class="rounded-full mr-3"
                                                 src="{{ gravatar_url(auth()->user()->email) }}">

                                            {{ auth()->user()->name }}
                                        </button>
                                    </template>

                                    <form id="logout-form" method="POST" action="/logout">
                                        @csrf
                                        <button type="subdmit" class="dropdown-menu-link w-full text-left">Logout</button>
                                    </form>
                                </dropdown>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="section">
            <main class="container mx-auto py-6">
                @yield('content')
            </main>
        </div>
        <nav id="footer" class="bg-header section">
            <div class="container mx-auto flex justify-between items-center py-1">
                    <div>
                        <h3>Abouts</h3>
                        <P>
                            About this site<br/>
                            Contact us<br/>
                            FAQ<br/>
                        </P>
                    </div>
                    <div>
                        <h3>Resources</h3>
                        <P>
                            About this site<br/>
                            Contact us<br/>
                            FAQ<br/>
                        </P>
                    </div>
                    <div>x</div>
                    <div>x</div>
            </div>
        </nav>
    </div>
</body>
</html>
