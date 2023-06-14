@extends('layouts.app')

@section('title', 'Favoritos')

@section('content')
    <!-- Aqui empieza el body -->

    <div class="w-full max-w-screen-lg mx-auto p-4">
        <div class="p-2">
            <h1
                class="mb-4 text-4xl text-center font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl text-white">
                Favoritos</h1>
        </div>

        <div class="justify-center">
            <div class="p-2">
                <h1
                    class="mb-4 text-xl text-center font-extrabold leading-none tracking-tight md:text-5xl lg:text-4xl text-white">
                    Peliculas</h1>
            </div>
            @if (!$peliculas->isEmpty())
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                    @foreach ($peliculas as $pelicula)
                        <div class="col-span-1">
                            <div
                                class="bg-gray-200 rounded-lg overflow-hidden border-2 hover:border-blue-500 hover:border-4">
                                <a href="{{ route('peliculas.show', compact('pelicula')) }}">
                                    <img loading="lazy" class="object-contain w-full h-full" src="{{ $pelicula->poster }}"
                                        alt="{{ $pelicula->titulo }} Poster">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-white text-center ">
                    <p>No se ha encontrado nada</p>
                </div>
            @endif
        </div>

        <div class="justify-center">
            <div class="p-2">
                <h1
                    class="mb-4 text-xl text-center font-extrabold leading-none tracking-tight md:text-5xl lg:text-4xl text-white">
                    Series</h1>
            </div>
            @if (!$series->isEmpty())
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                    @foreach ($series as $serie)
                        <div class="col-span-1">
                            <div
                                class="bg-gray-200 rounded-lg overflow-hidden border-2 hover:border-blue-500 hover:border-4">
                                <a href="{{ route('series.show', compact('serie')) }}">
                                    <img loading="lazy" class="object-contain w-full h-full" src="{{ $serie->poster }}"
                                        alt="{{ $serie->titulo }} Poster">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-white text-center ">
                    <p>No se ha encontrado nada</p>
                </div>
            @endif
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


    <!-- Aqui termina el body -->
@endsection
