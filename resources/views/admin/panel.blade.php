@extends('layouts.app')

@section('title', 'Panel de Control')

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
                Panel de Control</h1>
        </div>

        <div class="max-w mx-auto rounded-lg overflow-hidden mb-4 shadow-md bg-slate-700 text-white">
            <form class="p-4 space-y-4" action="{{ route('refrescar.peliculas') }}" method="POST">
                @csrf
                <h2 class="text-xl font-medium underline">Refrescar Peliculas</h2>
                <p>Se actualizaran los registros y se añadiran los que no estén</p>
                <div class="mb-4">
                    <label for="number" class="block font-mono text-white mb-1">Número de pagina</label>
                    <input type="number" id="number" name="number"
                        class="sm:w-96 px-3 py-2 border bg-slate-400 border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="1">
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @if (session()->has('exitoPelis'))
                        <div class="p-3 mb-3 text-sm rounded-lg bg-gray-800 text-green-400 col-span-3" role="alert">
                            <span class="font-medium">{{ session()->get('exitoPelis') }}</span>
                        </div>
                    @endif

                    <div class="col-end-5">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 font-medium py-2 px-4 rounded">
                            Refrescar Peliculas
                        </button>
                    </div>
                </div>
                
            </form>
        </div>

        <div class="max-w mx-auto rounded-lg overflow-hidden mb-4 shadow-md bg-slate-700 text-white">
            <form class="p-4 space-y-4" action="{{ route('refrescar.series') }}" method="POST">
                @csrf
                <h2 class="text-xl font-medium underline">Refrescar Series</h2>
                <p>Se actualizaran los registros y se añadiran los que no estén</p>
                <div class="mb-4">
                    <label for="number" class="block font-mono text-white mb-1">Número de pagina</label>
                    <input type="number" id="number" name="number"
                        class="sm:w-96 px-3 py-2 border bg-slate-400 border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="1">
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @if (session()->has('exitoSeries'))
                        <div class="p-3 mb-3 text-sm rounded-lg bg-gray-800 text-green-400 col-span-3" role="alert">
                            <span class="font-medium">{{ session()->get('exitoSeries') }}</span>
                        </div>
                    @endif

                    <div class="col-end-5">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 font-medium py-2 px-4 rounded">
                            Refrescar Series
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-400">
                <caption class="p-5 text-lg font-semibold text-left bg-gray-500 text-white">
                    <h2 class="text-xl font-medium underline">Usuarios</h2>
                    <p class="mt-1 text-sm font-normal">Aquí podras observar la lista de usuarios registrados
                        actualmente.</p>
                </caption>
                <thead class="text-xs uppercase bg-gray-400 text-black">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre de usuario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Correo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Administrador
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha Creación
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr class="border-b bg-gray-500 border-gray-700 hover:bg-gray-600">
                            <th scope="row" class="flex items-center px-6 py-4 font-medium whitespace-nowrap text-white">
                                <img class="w-10 h-10 rounded-full"
                                    src="{{ asset('storage/images/' . $usuario->ruta_foto_perfil) }}" alt="icon">
                                <div class="pl-4">
                                    <div class="text-base font-semibold">{{ $usuario->username }}</div>
                                    <div class="text-sm font-mono">{{ $usuario->nombre }}</div>
                                </div>
                                </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                {{ $usuario->email }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                @if ($usuario->esAdmin())
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                @endif
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                {{ $usuario->created_at }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
