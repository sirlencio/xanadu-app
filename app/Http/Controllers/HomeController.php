<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Serie;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Funcion que muestra el indice de la pagina principal
     * cargando las 5 primeras peliculas y las 5 primeras
     * series y de estar logueado el usuario, mostrarlo
     * 
     * @return view
     */
    public function index()
    {
        $peliculas = Pelicula::orderBy('popularidad', 'desc')->take(5)->get();
        $series = Serie::orderBy('popularidad', 'desc')->take(5)->get();

        if (Auth::check()) {
            $user = Auth::user();
            $username = $user->username;
            $email = $user->email;

            return view('index')
                ->with('peliculas', $peliculas)
                ->with('series', $series)
                ->with('username', $username)
                ->with('email', $email)
                ->with('nombre', ' ');
        }
        return view('index')
            ->with('peliculas', $peliculas)
            ->with('series', $series)
            ->with('nombre', ' ');
    }

    public function config()
    {
        $user = Auth::user();
        $username = $user->username;
        $email = $user->email;

        return view('usuario.config')
            ->with('username', $username)
            ->with('email', $email);
    }

    public function buscar(Request $request)
    {
        $nombre = $request->input('nombre');

        // Buscar películas cuyos títulos contengan o coincidan con el nombre
        $peliculas = Pelicula::where('titulo', 'like', '%' . $nombre . '%')->get();

        // Buscar series cuyos títulos contengan o coincidan con el nombre
        $series = Serie::where('titulo', 'like', '%' . $nombre . '%')->get();

        if ($peliculas->isEmpty() && $series->isEmpty()) {
            $msg = 'No se ha encontrado ningun resultado';
            return view('buscar')
                ->with('msg', $msg);
        }

        if ($peliculas->isEmpty()) {
            return view('buscar')
                ->with('series', $series)
                ->with('peliculas', collect()); // Pasar una colección vacía para evitar el error en la vista
        }

        if ($series->isEmpty()) {
            return view('buscar')
                ->with('peliculas', $peliculas)
                ->with('series', collect()); // Pasar una colección vacía para evitar el error en la vista
        }

        return view('buscar')
            ->with('peliculas', $peliculas)
            ->with('series', $series);
    }
}
