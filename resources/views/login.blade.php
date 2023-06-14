@extends('layouts.app')
<!-- Aqui metemos la plantilla -->

@section('title', 'Login')
<!-- Aqui le decimos el titulo de la pagina -->

@section('content')

    <div class="w-full max-w-screen-lg mx-auto p-4 flex-col">
        <div class="flex justify-center items-center h-screen">
            <form method="POST" class="w-full max-w-md rounded-lg shadow-md px-8 pt-6 pb-8 mb-4 text-white bg-slate-600">
                <h2 class="text-2xl font-bold mb-4">Login</h2>
                @csrf

                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="login">Nombre de usuario/Correo</label>
                    <input id="login" type="text"
                        class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        name="login" value="{{ old('login') }}" required autocomplete="login" autofocus>
                    @error('login')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 relative">
                    <label class="block text-white font-bold mb-2" for="password">Contraseña</label>
                    <input id="password" type="password"
                        class="appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        name="password" required autocomplete="new-password">
                    @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                @if (session()->has('success'))
                <div class="p-4 mb-4 text-sm rounded-lg bg-gray-800 text-green-400" role="alert">
                    <span class="font-medium">{{ session()->get('success') }}</span>
                  </div>
                @endif

                <div class="flex items-center mb-4">
                    <input id="default-checkbox" name="remember" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-300">Recuerdame</label>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Iniciar
                        Sesión
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                        href="{{ route('registro') }}">¿Quiere crear una cuenta? </a>
                </div>
            </form>
        </div>
    </div>
@endsection
