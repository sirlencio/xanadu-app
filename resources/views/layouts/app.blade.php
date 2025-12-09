<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @yield('styles')
    @yield('scripts')

</head>

<body class="border-gray-200 bg-gray-800">
    <header>
        <nav class="border-gray-200 bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{ route('index') }}" class="flex items-center">
                    <img src="{{ asset('logo.png') }}" class="h-8 mr-3" alt="Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Xanadu</span>
                </a>
                <div class="flex md:order-2">
                    <form id="busqueda" method="GET">
                        @csrf
                        <div class="relative hidden md:block">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Search icon</span>
                            </div>
                            <input type="text" id="search-navbar"
                                class="block w-full p-2 pl-10 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                name="nombre" required placeholder="Buscar...">
                        </div>
                    </form>
                    <button data-collapse-toggle="navbar-search" type="button"
                        class="inline-flex items-center p-2 text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600"
                        aria-controls="navbar-search" aria-expanded="false">
                        <span class="sr-only">Open menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex items-center md:order-2">
                    @if (auth()->check())
                        <button type="button"
                            class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-600"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                            data-dropdown-placement="bottom">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-11 h-11 rounded-full"
                                src="{{ asset('storage/images/' . auth()->user()->ruta_foto_perfil) }}"
                                alt="Foto de perfil">
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 hidden my-4 text-base list-none  divide-y rounded-lg shadow bg-gray-700 divide-gray-600"
                            id="user-dropdown">
                            <div class="px-4 py-3 text-center">
                                <span class="block text-sm text-white">{{ auth()->user()->username }}</span>
                                <span class="block text-sm  truncate text-gray-400">{{ auth()->user()->email }}</span>
                            </div>
                            <ul class="py-2" aria-labelledby="user-menu-button">
                                @if (auth()->user()->admin === 1)
                                    <li>
                                        <a href="{{ route('admin.panel') }}"
                                            class="block px-4 py-2 text-sm  hover:bg-gray-600 text-gray-200 hover:text-white">Panel
                                            de Control</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('vistos') }}"
                                        class="block px-4 py-2 text-sm  hover:bg-gray-600 text-gray-200 hover:text-white">Diario</a>
                                </li>
                                <li>
                                    <a href="{{ route('favoritos') }}"
                                        class="block px-4 py-2 text-sm  hover:bg-gray-600 text-gray-200 hover:text-white">Favoritos</a>
                                </li>
                                <li>
                                    <a href="{{ route('watchlist') }}"
                                        class="block px-4 py-2 text-sm  hover:bg-gray-600 text-gray-200 hover:text-white">Watchlist</a>
                                </li>
                                <li>
                                    <a href="{{ route('configuracion') }}"
                                        class="block px-4 py-2 text-sm  hover:bg-gray-600 text-gray-200 hover:text-white">Ajustes</a>
                                </li>
                                <li>
                                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="block px-4 py-2 text-sm  hover:bg-gray-600 text-gray-200 hover:text-white">Cerrar
                                        sesion</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif

                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
                    <div class="relative mt-3 md:hidden">
                        <form id="busqueda" method="GET">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="search-navbar"
                            class="block w-full p-2 pl-10 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" name="nombre"
                            placeholder="Buscar...">
                        </form>
                    </div>
                    <ul
                        class="flex flex-col p-4 md:p-0 mt-4 font-medium border rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 bg-gray-800 md:bg-gray-900 border-gray-700">
                        @if (!auth()->check())
                            <li>
                                <a href="{{ route('login') }}"
                                    class="block py-2 pl-3 pr-4 rounded md:p-0 md:hover:text-blue-500 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Inicia
                                    sesión</a>
                            </li>
                            <li>
                                <a href="{{ route('registro') }}"
                                    class="block py-2 pl-3 pr-4 rounded md:p-0 md:hover:text-blue-500 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Regístrate</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('peliculas.index') }}"
                                class="block py-2 pl-3 pr-4 rounded md:p-0 md:hover:text-blue-500 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Peliculas</a>
                        </li>
                        <li>
                            <a href="{{ route('series.index') }}"
                                class="block py-2 pl-3 pr-4 rounded md:p-0 md:hover:text-blue-500 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Series</a>
                        </li>
                        <li>
                            <a href="{{ route('libros') }}"
                                class="block py-2 pl-3 pr-4 rounded md:p-0 md:hover:text-blue-500 text-white hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700">Libros</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Script para la funcion de busqueda -->
    <script>
        $(function() {
            $("#search-navbar").on('change', function(e) {
                {{ route('buscar', ['nombre' => 'spider']) }}
                $("#busqueda").attr("action",
                    "{{ route('buscar', ['nombre' => '" + $(this).val() + "']) }}");
            });
        });
    </script>

    @yield('content')

    <div class="flex flex-col min-h-screen">
        <footer class="bg-transparent bottom-0 w-full mt-auto">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a href="{{ route('index') }}" class="flex items-center mb-4 sm:mb-0">
                        <img src="{{ asset('logo.png') }}" class="h-8 mr-3" alt="Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Xanadu</span>
                    </a>
                    <ul class="flex flex-wrap items-center mb-6 text-sm font-medium sm:mb-0 text-gray-400">
                        <li>
                            <a href="{{ route('sobre-nosotros') }}" class="mr-4 hover:underline md:mr-6 ">Sobre
                                nosotros</a>
                        </li>
                        <li>
                            <a href="{{ route('contacto') }}" class="hover:underline">Contacto</a>
                        </li>
                    </ul>
                </div>
                <hr class="my-6 sm:mx-auto border-gray-700 lg:my-8" />
                <span class="block text-sm sm:text-center text-gray-400">© 2023 <a href="/"
                        class="hover:underline">Xanadu™</a>. All Rights Reserved.</span>
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
