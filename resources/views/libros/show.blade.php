@extends('layouts.app')
<!-- Aqui metemos la plantilla -->

@section('title', $libro)
<!-- Aqui le decimos el titulo de la pagina -->

@section('content')
    <!-- Aqui empieza el body -->

    <h1 class="mb-4 text-4xl text-center font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl text-white">{{$libro}}</h1>
    
@endsection

<!-- Aqui termina el body -->