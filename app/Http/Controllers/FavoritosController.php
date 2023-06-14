<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Serie;

class FavoritosController extends Controller
{
   
    public function index()
    {
        $user = auth()->user();
        $peliculas = $user->peliculasFavoritas;
        $series = $user->seriesFavoritas;
    
        return view('usuario.favlist', compact('peliculas', 'series'));
    }
    

    public function addToFavoritos($type, $id)
    {
        $user = auth()->user();

        if ($type === 'pelicula') {
            $pelicula = Pelicula::find($id);
            $pelicula->usuariosQueDieronFav()->sync($user->id);
        } elseif ($type === 'serie') {
            $serie = Serie::find($id);
            $serie->usuariosQueDieronFav()->sync($user->id);
        }
    
        return redirect()->back();
    }
    

    public function removeFromFavoritos($type, $id)
    {
        $user = auth()->user();

        if ($type === 'pelicula') {
            $pelicula = Pelicula::find($id);
            $pelicula->usuariosQueDieronFav()->detach($user->id);
        } elseif ($type === 'serie') {
            $serie = Serie::find($id);
            $serie->usuariosQueDieronFav()->detach($user->id);
        }

        return redirect()->back();
    }

}
