@extends('layouts.app')
<!-- Aqui metemos la plantilla -->

@section('title', 'Inicio')
<!-- Aqui le decimos el titulo de la pagina -->

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ Vite::asset('resources/js/scroll-to-top.js') }}"></script>
@endsection

@section('content')
    <!-- Aqui empieza el body -->

    <div class="w-full max-w-screen-lg mx-auto p-4 flex-col">
        <div class="p-2">
            <h1
                class="mb-4 text-4xl text-center font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl text-white">
                Xanadu</h1>
        </div>
        @if (session()->has('success'))
            <div class="p-4 mb-4 text-sm rounded-lg bg-gray-800 text-blue-400"
                role="alert">
                <span class="font-medium">{{ session()->get('success') }}</span>
            </div>
        @endif

        <div class="flex-grow">
            <h2 class="text-3xl font-bold text-white ml-4 mb-4">Peliculas populares</h2>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                @foreach ($peliculas as $pelicula)
                    <div class="col-span-1 px-2 mb-4">
                        <div class="bg-gray-200 rounded-lg overflow-hidden border-2 hover:border-blue-500 hover:border-4">
                            <a href="{{ route('peliculas.show', compact('pelicula')) }}"><img loading="lazy"
                                    class="w-44 h-66" src="{{ $pelicula->poster }}"
                                    alt="{{ $pelicula->titulo }} Poster"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex-grow">
            <h2 class="text-3xl font-bold text-white ml-4 mb-4">Series populares</h2>
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                @foreach ($series as $serie)
                    <div class="col-span-1 px-2 mb-4">
                        <div class="bg-gray-200 rounded-lg overflow-hidden border-2 hover:border-blue-500 hover:border-4">
                            <a href="{{ route('series.show', compact('serie')) }}"><img loading="lazy"
                                    src="{{ $serie->poster }}" alt="{{ $serie->titulo }} Poster"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="scroll-to-top" class="fixed bottom-0 right-0 mr-8 mb-6 z-10 hidden">
            <button type="button" data-mdb-ripple="true" data-mdb-ripple-color="light"
                class="inline-block p-3 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out bottom-5 right-5">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-4 h-4" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor"
                        d="M34.9 289.5l-22.2-22.2c-9.4-9.4-9.4-24.6 0-33.9L207 39c9.4-9.4 24.6-9.4 33.9 0l194.3 194.3c9.4 9.4 9.4 24.6 0 33.9L413 289.4c-9.5 9.5-25 9.3-34.3-.4L264 168.6V456c0 13.3-10.7 24-24 24h-32c-13.3 0-24-10.7-24-24V168.6L69.2 289.1c-9.3 9.8-24.8 10-34.3.4z">
                    </path>
                </svg>
            </button>
        </div>
    </div>
@endsection
<!-- Aqui termina el body -->
