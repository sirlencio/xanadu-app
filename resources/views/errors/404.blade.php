@extends('layouts.app')
<!-- Aqui metemos la plantilla -->

@section('title', 'Error 404 - Página no encontrada')
<!-- Aqui le decimos el titulo de la pagina -->

@section('content')
    <!-- Aqui empieza el body -->

    <div class="w-full max-w-screen-lg mx-auto p-4 flex-co">
        <div class="max-w-md mx-auto p-14 text-center text-white">
            <h1 class="text-6xl font-bold mb-12">Error 404 - Página no encontrada</h1>
            <p class="text-2xl mb-8">Lo siento, la página que buscas no existe.</p>
            <a class="text-blue-500 hover:text-blue-700 text-xl" href="{{ url('/') }}"">Volver al inicio</a>
        </div>
    </div>

@endsection
<!-- Aqui termina el body -->
