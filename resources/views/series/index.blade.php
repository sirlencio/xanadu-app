@extends('layouts.app')
<!-- Aqui metemos la plantilla -->

@section('title', 'Series')
<!-- Aqui le decimos el titulo de la pagina -->

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ Vite::asset('resources/js/scroll-to-top.js') }}"></script>
@endsection

@section('content')
    <!-- Aqui empieza el body -->

    <div class="w-full max-w-screen-lg mx-auto p-4">
        <div class="p-2">
            <h1
                class="mb-4 text-4xl text-center font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl text-white">
                Series</h1>
        </div>

        <div class="mb-4">
            <form method="POST" action="{{ route('series.filtrar') }}" class="flex justify-center flex-col gap-4 md:flex-row items-center">
                @csrf

                <!-- Filtro generos -->
                <div class="mr-4">
                    <button data-dropdown-toggle="menu_generos" data-dropdown-trigger="click"
                        class="text-white focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center bg-gray-700 focus:ring-blue-800"
                        type="button">Generos<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="menu_generos" class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-700">
                        <ul class="text-xs font-medium text-white">
                            @foreach ($generos as $genero)
                                <li class="w-full rounded-t-lg">
                                    <div class="flex items-center pl-3 hover:bg-gray-600 hover:text-white rounded-lg">
                                        <input id="checkbox-{{ $genero->nombre_genero }}" name="generos[]" type="checkbox"
                                            value="{{ $genero->id }}"
                                            class="w-4 h-4 text-blue-600 rounded focus:ring-blue-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2 bg-gray-600 border-gray-500"
                                            @if (is_array(request()->input('generos')) && in_array($genero->id, request()->input('generos'))) checked @endif>
                                        <label for="checkbox-{{ $genero->nombre_genero }}"
                                            class="w-full py-3 ml-2 text-sm font-medium text-gray-300">{{ $genero->nombre_genero }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Filtro año publicacion -->
                <div class="mr-4">
                    <button data-dropdown-toggle="menu_anios" data-dropdown-trigger="click"
                        class="text-white focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center bg-gray-700 focus:ring-blue-800"
                        type="button">Año publicación<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="menu_anios" class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-700">
                        <ul class="text-xs font-medium text-white">
                            @foreach ($anios as $anio)
                                <li class="w-full rounded-t-lg">
                                    <div class="flex items-center pl-3 hover:bg-gray-600 hover:text-white rounded-lg">
                                        <input id="checkbox-{{ $anio }}" name="anio[]" type="checkbox"
                                            value="{{ $anio }}"
                                            class="w-4 h-4 rounded focus:ring-blue-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2 bg-gray-600 border-gray-500"
                                            @if (is_array(request()->input('anio')) && in_array($anio, request()->input('anio'))) checked @endif>
                                        <label for="checkbox-{{ $anio }}"
                                            class="w-full py-3 ml-2 text-sm font-medium text-gray-300">{{ $anio }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Filtro orden -->
                <div class="mr-4">
                    <button data-dropdown-toggle="menu_orden" data-dropdown-trigger="click"
                        class="text-white focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center bg-gray-700 focus:ring-blue-800"
                        type="button">Ordenar por:<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg></button>
                    <div id="menu_orden" class="z-10 hidden divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-700">
                        <ul class="text-xs font-medium text-white">
                            <li class="w-full rounded-t-lg">
                                <div class="flex items-center pl-3 hover:bg-gray-600 hover:text-white rounded-lg">
                                    <input id="orden_defecto" type="radio" name="orden" value="default"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2 bg-gray-600 border-gray-500"
                                        @if ($orden === 'defecto') checked @endif>
                                    <label for="orden_defecto" class="w-full py-3 ml-2 text-sm font-medium text-gray-300">
                                        Defecto
                                    </label>
                                </div>
                                <div class="flex items-center pl-3 hover:bg-gray-600 hover:text-white rounded-lg">
                                    <input id="orden_nombre" type="radio" name="orden" value="nombre"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2 bg-gray-600 border-gray-500"
                                        @if ($orden === 'nombre') checked @endif>
                                    <label for="orden_nombre" class="w-full py-3 ml-2 text-sm font-medium text-gray-300">
                                        Nombre
                                    </label>
                                </div>
                                <div class="flex items-center pl-3 hover:bg-gray-600 hover:text-white rounded-lg">
                                    <input id="orden_fecha" type="radio" name="orden" value="fecha"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2 bg-gray-600 border-gray-500"
                                        @if ($orden === 'fecha') checked @endif>
                                    <label for="orden_fecha" class="w-full py-3 ml-2 text-sm font-medium text-gray-300">
                                        Fecha
                                    </label>
                                </div>
                                <div class="flex items-center pl-3 hover:bg-gray-600 hover:text-white rounded-lg">
                                    <input id="popularidad_asc" type="radio" name="orden" value="popularidad_asc"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2 bg-gray-600 border-gray-500"
                                        @if ($orden === 'popularidad_asc') checked @endif>
                                    <label for="popularidad_asc"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-300">
                                        Popularidad ascendete
                                    </label>
                                </div>
                                <div class="flex items-center pl-3 hover:bg-gray-600 hover:text-white rounded-lg">
                                    <input id="popularidad_desc" type="radio" name="orden" value="popularidad_desc"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2 bg-gray-600 border-gray-500"
                                        @if ($orden === 'popularidad_desc') checked @endif>
                                    <label for="popularidad_desc"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-300">
                                        Popularidad descendete
                                    </label>
                                </div>
                    </div>
                </div>

                <!-- Filtro por nombre -->
                <div class="mr-4">
                    <input type="text" name="nombre" placeholder="Buscar por nombre"
                        class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2.5 inline-flex items-center bg-gray-700 focus:ring-blue-800"
                        value="{{ $nombre }}">
                </div>

                <div class="mb-2">
                    <button type="submit"
                        class="text-white focus:outline-none focus:ring-4 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Filtrar</button>
                </div>
            </form>
        </div>

        <!--Todas las series-->
        <div class="justify-center">
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                @foreach ($series as $serie)
                    <div class="col-span-1">
                        <div class="bg-gray-200 rounded-lg overflow-hidden border-2 hover:border-blue-500 hover:border-4">
                            <a href="{{ route('series.show', compact('serie')) }}">
                                <img loading="lazy" class="object-contain w-full h-full" src="{{ $serie->poster }}"
                                    alt="{{ $serie->titulo }} Poster">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div id="scroll-to-top" class="fixed bottom-0 right-0 mr-8 mb-6 z-10 hidden">
        <button type="button"
            class="text-white font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 bg-blue-600 hover:bg-blue-700">
            <svg aria-hidden="true" class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 6l-5 5 1.41 1.41L10 8.83l3.59 3.58L15 11l-5-5z"></path>
            </svg>
            <span class="sr-only">Scroll to top</span>
        </button>
    </div>
    </div>


    <!-- Aqui termina el body -->
@endsection
