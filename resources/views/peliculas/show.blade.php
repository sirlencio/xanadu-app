@extends('layouts.app')
<!-- Aqui metemos la plantilla -->

@section('title', $pelicula->titulo)
<!-- Aqui le decimos el titulo de la pagina -->

@section('content')
    <!-- Aqui empieza el body -->
    <div class="w-full max-w-screen-lg mx-auto p-4 mt-14">
        <div class="flex flex-col md:flex-row items-center">
            <div class="flex-shrink-0 md:mr-8 bg-gray-200 rounded-lg overflow-hidden border-2">
                <img src="{{ $pelicula->poster }}" alt="{{ $pelicula->titulo }}" class="w-64 h-auto mb-4">
            </div>
            <div class="flex flex-col md:flex-1">
                <h1
                    class="mb-10 text-4xl text-center md:text-left font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl text-white">
                    {{ $pelicula->titulo }}
                </h1>
                <div class="mt-4">
                    @if ($pelicula->sinopsis == '')
                        <p class="text-lg text-gray-300 mb-4">Aqui no hay nada que mostrar</p>
                    @else
                        <p class="text-lg text-gray-300 mb-4">{{ $pelicula->sinopsis }}</p>
                    @endif
                </div>
                <div class="mt-4">
                    <p class="text-gray-400">Duración: {{ $pelicula->duracion }} minutos</p>
                </div>
            </div>
        </div>
        @auth
            <div class="flex justify-center flex-col gap-10 md:flex-row items-center mt-10">
                <!-- Boton Watchlist-->
                @if (auth()->user()->watchlist != null &&
                        auth()->user()->watchlist->peliculas != null &&
                        auth()->user()->watchlist->peliculas->contains($pelicula->id))
                    <form action="{{ route('watchlist.remove', ['type' => 'pelicula', 'id' => $pelicula->id]) }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white border focus:outline-none font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2 border-blue-500 bg-blue-500">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM6 6a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1H6z" />
                            </svg>
                            Quitar de Watchlist
                        </button>
                    </form>
                @else
                    <form action="{{ route('watchlist.add', ['type' => 'pelicula', 'id' => $pelicula->id]) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="border font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2 border-blue-500 text-blue-500">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                <path
                                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                            </svg>
                            Añadir a Watchlist
                        </button>
                    </form>
                @endif

                <!-- Boton Favoritos-->
                @if (auth()->user()->peliculasFavoritas != null &&
                        auth()->user()->peliculasFavoritas->contains($pelicula->id))
                    <form action="{{ route('favoritos.remove', ['type' => 'pelicula', 'id' => $pelicula->id]) }}"
                        method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white border focus:outline-none font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2 border-blue-500 bg-blue-500">
                            <svg viewBox="2 2 20 20" class="w-5 h-5 mr-2 -ml-1" fill="none"
                                xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M10 9.5L14 13.5M14 9.5L10 13.5M12 6.59097L11.8456 6.42726C9.86802 4.33054 6.5974 4.57698 4.91936 6.94915C3.43 9.05459 3.78669 12.0335 5.72501 13.6776L12 19L18.275 13.6776C20.2133 12.0335 20.57 9.05459 19.0807 6.94915C17.4026 4.57698 14.132 4.33054 12.1544 6.42726L12 6.59097Z"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            Quitar de Favoritos
                        </button>
                    </form>
                @else
                    <form action="{{ route('favoritos.add', ['type' => 'pelicula', 'id' => $pelicula->id]) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="border font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2 border-blue-500 text-blue-500">
                            <svg viewBox="2 2 20 20" class="w-5 h-5 mr-2 -ml-1" fill="none"
                                xmlns="http://www.w3.org/2000/svg" stroke-width="2">
                                <path
                                    d="M9 11.2857L10.8 13L15 9M12 6.59097L11.8456 6.42726C9.86801 4.33053 6.59738 4.57698 4.91934 6.94915C3.42999 9.05459 3.78668 12.0335 5.725 13.6776L12 19L18.275 13.6776C20.2133 12.0335 20.57 9.05459 19.0807 6.94915C17.4026 4.57697 14.132 4.33053 12.1544 6.42726L12 6.59097Z"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            Añadir a Favoritos
                        </button>
                    </form>
                @endif

                <!-- Boton Vistos-->
                @if (auth()->user()->peliculasVistas != null &&
                        auth()->user()->peliculasVistas->contains($pelicula->id))
                    <form action="{{ route('vistos.remove', ['type' => 'pelicula', 'id' => $pelicula->id]) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="text-white border focus:outline-none font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2 border-blue-500 bg-blue-500">
                            <svg viewBox="0 0 24 24" class="w-5 h-5 mr-2 -ml-1" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 14V7C20 5.34315 18.6569 4 17 4H12M20 14L13.5 20M20 14H15.5C14.3954 14 13.5 14.8954 13.5 16V20M13.5 20H7C5.34315 20 4 18.6569 4 17V12"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M4 4L6.5 6.5M9 9L6.5 6.5M6.5 6.5L9 4M6.5 6.5L4 9" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            Quitar de Diario
                        </button>
                    </form>
                @else
                    <form action="{{ route('vistos.add', ['type' => 'pelicula', 'id' => $pelicula->id]) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="border font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2 border-blue-500 text-blue-500">
                            <svg viewBox="0 0 24 24" class="w-5 h-5 mr-2 -ml-1" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20 14V7C20 5.34315 18.6569 4 17 4H12M20 14L13.5 20M20 14H15.5C14.3954 14 13.5 14.8954 13.5 16V20M13.5 20H7C5.34315 20 4 18.6569 4 17V12"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M7 4V7M7 10V7M7 7H4M7 7H10" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            Añadir a Diario
                        </button>
                    </form>
                @endif

            @endauth
        </div>

    @endsection

    <!-- Aqui termina el body -->
