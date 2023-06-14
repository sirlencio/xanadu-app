<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibrosController extends Controller
{
    /**
     * Funcion que muestra todas los libros de la base de datos
     * 
     * @return view Vista con todas las peliculas, los generos y los años de publicacion
     */
    public function index()
    {
        return view('libros.index');
    }

}
