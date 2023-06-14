@extends('layouts.app')
<!-- Aqui metemos la plantilla -->

@section('title', 'Registro')
<!-- Aqui le decimos el titulo de la pagina -->

@section('content')
    <!-- Aqui empieza el body -->

    <div class="w-full max-w-screen-lg mx-auto p-4 flex-col">
        <div class="flex justify-center items-center h-screen">
            <form method="POST" class="w-full max-w-md rounded-lg shadow-md px-8 pt-6 pb-8 mb-4 text-white bg-slate-600">
                <h2 class="text-2xl font-bold mb-4">Registro</h2>
                @csrf

                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="username">Nombre de usuario</label>
                    <input id="username" type="text"
                        class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @error('username')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="email">Email</label>
                    <input id="email" type="email"
                        class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="password">Contraseña</label>
                    <input id="password" type="password"
                        class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        name="password" required autocomplete="new-password">
                    @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="password-confirm">Confirmar Contraseña</label>
                    <input id="password-confirm" type="password"
                        class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrar
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                        href="{{ route('login') }}">¿Ya tiene una cuenta?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
<!-- Aqui termina el body -->