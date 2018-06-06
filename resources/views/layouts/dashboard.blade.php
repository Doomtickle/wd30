<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body class="h-screen font-Lato text-smoke-darkest bg-brand">
    <div id="app" class="relative">
        <nav class="fixed bg-white w-full z-50 shadow">
            <div class="container mx-auto h-full">
                <div class="flex flex-row items-center justify-center">
                    <div class="flex-1 m-0 mx-2">
                        @include('partials.logo')
                        <a href="{{ route('logout') }}"
                            class="no-underline hover:underline text-smoke-darker px-4 py-4 md:px-8 md:py-7 lg:px-10 my-1 fixed pin-t pin-r"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <span class="mb-2 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <div class='w-full bg-image-full bg-fixed px-1 pt-16 pb-4' style='background-image: url("{{ $header_photo_path }}");'>
            @yield('top')
        </div>
        <div class='bg-beachy-blue pb-16 shadow-inner'>
            @yield('content')
        </div>
        <div class=''>
            @yield('help')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
