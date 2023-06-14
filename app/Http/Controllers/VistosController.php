<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Serie;

class VistosController extends Controller
{
    
    public function index()
    {
        $user = auth()->user();
        $peliculas = $user->peliculasVistas;
        $series = $user->seriesVistas;
    
        return view('usuario.diary', compact('peliculas', 'series'));
    }
    

    public function addToVistos($type, $id)
    {
        $user = auth()->user();

        if ($type === 'pelicula') {
            $pelicula = Pelicula::find($id);
            $pelicula->usuariosQueHanVisto()->sync($user->id);
        } elseif ($type === 'serie') {
            $serie = Serie::find($id);
            $serie->usuariosQueHanVisto()->sync($user->id);
        }
    
        return redirect()->back();
    }
    

    public function removeFromVistos($type, $id)
    {
        $user = auth()->user();

        if ($type === 'pelicula') {
            $pelicula = Pelicula::find($id);
            $pelicula->usuariosQueHanVisto()->detach($user->id);
        } elseif ($type === 'serie') {
            $serie = Serie::find($id);
            $serie->usuariosQueHanVisto()->detach($user->id);
        }

        return redirect()->back();
    }
}
