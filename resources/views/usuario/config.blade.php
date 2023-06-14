@extends('layouts.app')

@section('title', 'Configuracion')

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ Vite::asset('resources/js/scroll-to-top.js') }}"></script>
@endsection

@section('content')
    <!-- Aqui empieza el body -->

    <div class="w-full max-w-screen-lg mx-auto p-4">
        <div class="p-2 pb-10">
            <h1
                class="mb-4 text-4xl text-center font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl text-white">
                Configuración</h1>
        </div>

        <div class="max-w mx-auto rounded-lg overflow-hidden shadow-md mb-4 bg-slate-700 text-white">
            <form class="p-4 space-y-4" action="{{ route('perfil.cambiarNombre') }}" method="POST">
                @csrf
                <h2 class="text-xl font-medium underline">Cambiar nombre</h2>

                <!-- Campo para el nombre -->
                <div class="mb-4">
                    <label for="name" class="block font-medium text-white mb-1">Nombre</label>
                    <input id="name" type="name" name="name" required
                        class="sm:w-96 px-3 py-2 border bg-slate-400 border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        value="{{ auth()->user()->nombre }}">
                </div>
                @error('name')
                    <div class="p-3 mb-3 sm:w-96 text-sm rounded-lg bg-gray-800 text-red-400" role="alert">
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                @enderror

                <div class="grid grid-cols-3 gap-4">
                    @if (session()->has('exitoNombre'))
                        <div class="p-3 mb-3 text-sm rounded-lg bg-gray-800 text-green-400 col-span-3" role="alert">
                            <span class="font-medium">{{ session()->get('exitoNombre') }}</span>
                        </div>
                    @endif

                    <div class="col-end-5">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded">
                            Cambiar nombre
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="max-w mx-auto rounded-lg overflow-hidden shadow-md mb-4 bg-slate-700 text-white">
            <form class="p-4 space-y-4" action="{{ route('perfil.cambiarContrasenia') }}" method="POST">
                @csrf
                <h2 class="text-xl font-medium underline">Cambiar contraseña</h2>

                <!-- Campo para la contraseña actual -->
                <div class="mb-4">
                    <label for="current_password" class="block font-medium text-white mb-1">Contraseña actual</label>
                    <input id="current_password" type="password" name="current_password" required
                        class="sm:w-96 px-3 py-2 border bg-slate-400 border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                @if (session()->has('error'))
                    <div class="p-3 mb-3 sm:w-96 text-sm rounded-lg bg-gray-800 text-red-400" role="alert">
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Campo para la nueva contraseña -->
                <div class="mb-4">
                    <label for="new_password" class="block font-medium text-white mb-1">Nueva contraseña</label>
                    <input id="new_password" type="password" name="new_password" required autocomplete="new-password"
                        class="sm:w-96 px-3 py-2 border bg-slate-400 border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                @error('new_password')
                    <div class="p-3 mb-3 sm:w-96 text-sm rounded-lg bg-gray-800 text-red-400" role="alert">
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                @enderror

                <!-- Campo para confirmar la nueva contraseña -->
                <div class="mb-4">
                    <label for="new_password_confirmation" class="block font-medium text-white mb-1">Confirmar
                        contraseña</label>
                    <input id="new_password_confirmation" type="password" name="new_password_confirmation" required
                        autocomplete="new-password"
                        class="sm:w-96 px-3 py-2 border bg-slate-400 border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="grid grid-cols-3 gap-4">
                    @if (session()->has('exitoContra'))
                        <div class="p-3 mb-3 text-sm rounded-lg bg-gray-800 text-green-400 col-span-3" role="alert">
                            <span class="font-medium">{{ session()->get('exitoContra') }}</span>
                        </div>
                    @endif

                    <div class="col-end-5">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded">
                            Cambiar contraseña
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="max-w mx-auto rounded-lg overflow-hidden shadow-md bg-slate-700 mb-4 text-white">
            <form class="p-4 space-y-4" action="{{ route('perfil.cambiarFoto') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <h2 class="text-xl font-medium underline">Cambiar foto de perfil</h2>

                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer hover:bg-bray-800 bg-gray-700 border-gray-600 hover:border-gray-500 hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para
                                    subir</span> o arrastra y suelta</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG o GIF (MAX. 2MB)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="unhidden" name="subida" accept="image/*"
                            required />
                    </label>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    @if (session()->has('exitoFoto'))
                        <div class="p-3 mb-3 text-sm rounded-lg bg-gray-800 text-green-400 col-span-3" role="alert">
                            <span class="font-medium">{{ session()->get('exitoFoto') }}</span>
                        </div>
                    @endif

                    <div class="col-end-5">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded">
                            Cambiar foto de perfil
                        </button>
                    </div>
                </div>

            </form>
        </div>
        @if (auth()->user()->admin == 0)
            <div class="max-w mx-auto rounded-lg overflow-hidden shadow-md bg-slate-700 mb-4 text-white">
                <form class="p-4 space-y-4" action="{{ route('perfil.darBaja') }}" method="POST">
                    @csrf
                    <h2 class="text-xl font-medium">Borrar cuenta</h2>
                    <p class="mt-1 text-base font-normal text-left">Se dará de baja tu cuenta.</p>
                    <div class="grid grid-cols-3 gap-4">
                        @if (session()->has('seguridad'))
                            <div class="p-3 mb-3 text-sm rounded-lg bg-gray-800 text-red-400 col-span-3" role="alert">
                                <span class="font-medium">{{ session('seguridad') }}</span>
                            </div>
                        @endif

                        <div class="col-end-5">
                            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button"
                                class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded">
                                Borrar cuenta
                            </button>
                        </div>
                    </div>

                    <div id="popup-modal" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative rounded-lg shadow bg-gray-700">
                                <button type="button"
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-gray-800 hover:text-white"
                                    data-modal-hide="popup-modal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Cerrar Modal</span>
                                </button>
                                <div class="p-6 text-center">
                                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-200" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-400">¿Estas seguro de que quieres borrar
                                        la cuenta?</h3>

                                    <div class="mb-4">
                                        <label class="block text-white font-bold mb-2" for="password">Introduzca su
                                            contraseña</label>
                                        <input id="password" type="password"
                                            class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-gray-500 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                            name="password" required autocomplete="new-password">
                                        @error('password')
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Estoy seguro
                                    </button>
                                    <button data-modal-hide="popup-modal" type="button"
                                        class="focus:ring-4 focus:outline-none text-sm font-medium px-5 py-2.5 focus:z-10 bg-gray-700 text-gray-300 border-gray-500 hover:text-white hover:bg-gray-600 focus:ring-gray-600">No,
                                        cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        @endif
    </div>


    <!-- Aqui termina el body -->
@endsection
