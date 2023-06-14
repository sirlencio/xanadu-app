@extends('layouts.app')
<!-- Aqui metemos la plantilla -->

@section('title', 'Contacto')
<!-- Aqui le decimos el titulo de la pagina -->

@section('content')
    <!-- Aqui empieza el body -->
    <div class="w-full max-w-screen-lg mx-auto p-4 flex-col">
        <div class="p-2">
            <h1
                class="mb-4 text-4xl text-center font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl text-white">
                Contacto</h1>
            <p class="text-lg text-center text-white mt-5">
                ¡Gracias por visitar nuestra página de contacto! Si tienes alguna pregunta, consulta o simplemente quieres
                ponerte en contacto con nosotros, no dudes en hacerlo. Estamos aquí para ayudarte.
            </p>
            <p class="text-lg text-center mt-5 text-white">
                Puedes comunicarte con nosotros a través de los siguientes medios:
            </p>
            <ul class="text-lg text-center mt-5 text-white">
                <li>Teléfono: +123456789</li>
                <li>Correo electrónico: info@ejemplo.com</li>
                <li>Redes sociales:
                    <a href="https://www.facebook.com/" class="text-blue-500 hover:text-blue-700" target="_blank">Facebook</a>,
                    <a href="https://twitter.com/" class="text-blue-500 hover:text-blue-700" target="_blank">Twitter</a>,
                    <a href="https://www.instagram.com/" class="text-blue-500 hover:text-blue-700"
                        target="_blank">Instagram</a>
                </li>
            </ul>
            <p class="text-lg text-center mt-5 text-white">
                No dudes en contactarnos en cualquier momento. Estamos ansiosos por escucharte y responder a todas tus
                preguntas
                o inquietudes.
            </p>
        </div>
    </div>

@endsection
<!-- Aqui termina el body -->
