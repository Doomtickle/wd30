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
<body class="h-screen font-Lato text-smoke-darkest">
    <div id="app" class="relative">
        <nav class="fixed bg-tan-lightest w-full z-50 shadow-md">
            <div class="container mx-auto h-full">
                <div class="flex flex-col md:flex-row items-center justify-center">
                    <div class="mr-6 py-2">
                        @include('partials.logo')
                    </div>
                    <div class="flex-1 text-right align-middle h-16 pb-4 md:py-0">
                        <span class="text-brand text-sm pr-4" v-if="! boilerplate">@{{ user.name }}</span>
                        <span class="text-brand text-sm pr-4" v-else>Your Name</span>

                        <a href="{{ route('logout') }}"
                            class="no-underline hover:underline text-brand-dark text-sm py-4"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
                            <svg class="inline-block fill-current text-brand-dark h-6 w-6 mt-4 -mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 20 100 40">
                            <path d="M50,11.4c-17.7,0-32.7,12.1-37,28.6c0,0,0,0,0,0c0,0.1,0,0.1,0,0.2c-0.2,0.6-0.3,1.3-0.4,2c0,0.2-0.1,0.5-0.1,0.7  c-0.1,0.5-0.2,1-0.2,1.5c0,0.3-0.1,0.5-0.1,0.8c-0.1,0.5-0.1,1-0.1,1.6c0,0.2,0,0.4-0.1,0.7c0,0.7-0.1,1.5-0.1,2.2  c0,0.8,0,1.5,0.1,2.2c0,0.2,0,0.4,0.1,0.7c0,0.5,0.1,1.1,0.2,1.6c0,0.3,0.1,0.5,0.1,0.7c0.1,0.5,0.2,1,0.2,1.5  c0,0.2,0.1,0.5,0.1,0.7c0.1,0.7,0.3,1.3,0.4,2c0,0.1,0,0.1,0,0.2c0,0,0,0,0,0c4.3,16.4,19.2,28.6,37,28.6  c21.1,0,38.2-17.1,38.2-38.2S71.1,11.4,50,11.4z M46.4,57H16.3c0-0.1,0-0.1-0.1-0.2c-0.1-0.3-0.1-0.6-0.2-0.9  c-0.1-0.3-0.1-0.6-0.2-0.8c-0.1-0.4-0.1-0.7-0.1-1.1c0-0.2-0.1-0.4-0.1-0.7c0-0.4-0.1-0.9-0.1-1.3c0-0.2,0-0.3,0-0.5  c0-0.6,0-1.2,0-1.8c0-0.6,0-1.2,0-1.8c0-0.2,0-0.3,0-0.5c0-0.4,0.1-0.9,0.1-1.3c0-0.2,0.1-0.5,0.1-0.7c0-0.4,0.1-0.7,0.1-1.1  c0-0.3,0.1-0.6,0.2-0.9c0.1-0.3,0.1-0.6,0.2-0.9c0-0.1,0-0.1,0.1-0.2h30.1c1,0,1.8-0.8,1.8-1.8v-7l16.5,16c0.1,0.1,0.1,0.2,0.2,0.2  c0,0,0,0.1-0.2,0.2L48.3,65.8v-7C48.3,57.8,47.4,57,46.4,57z M50,84.2c-15.2,0-28.1-9.9-32.7-23.5h27.3v7.9c0,0.1,0,0.1,0,0.2  c0.2,1.8,1.4,2.4,2.3,2.4c1.1,0,1.8-0.7,2.1-1l18.3-17.7c1.1-1,1.3-2.1,1.3-2.8c0-1.5-0.9-2.5-1.3-2.9L48.9,29c-0.3-0.2-1-1-2.1-1  c-0.9,0-2,0.6-2.3,2.2c0,0.1,0,0.2,0,0.3v8.2H17.3C21.9,25,34.8,15.1,50,15.1c19,0,34.5,15.5,34.5,34.5S69,84.2,50,84.2z">
                            </path></svg>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <div class='w-full bg-tan-lightest pt-24 pb-8'>
            @yield('top')
        </div>
        <div class='bg-beachy-blue pb-16'>
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
