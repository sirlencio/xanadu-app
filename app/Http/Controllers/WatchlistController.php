<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Serie;
use App\Models\Watchlist;


class WatchlistController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $watchlist = $user->watchlist;
        $peliculas = $watchlist ? $watchlist->peliculas : null;
        $series = $watchlist ? $watchlist->series : null;
    
        return view('usuario.watchlist', compact('peliculas', 'series'));
    }
    

    public function addToWatchlist($type, $id)
    {
        $model = $this->getModel($type);
        $item = $model::findOrFail($id);
        $user = auth()->user();
    
        $watchlist = $user->watchlist;
        
        if (!$watchlist) {
            $watchlist = new Watchlist();
            $watchlist->id_usuario = $user->id;
            $watchlist->save();
        }

        if ($type === 'pelicula') {
            $watchlist->peliculas()->attach($item);
        } elseif ($type === 'serie') {
            $watchlist->series()->attach($item);
        }
    
        return redirect()->back();
    }
    

    public function removeFromWatchlist($type, $id)
    {
        $model = $this->getModel($type);
        $item = $model::findOrFail($id);
        $user = auth()->user();
        
        $watchlist = $user->watchlist;
        if ($watchlist) {
            if ($type === 'pelicula') {
                $watchlist->peliculas()->detach($item);
            } elseif ($type === 'serie') {
                $watchlist->series()->detach($item);
            }
        }

        return redirect()->back();
    }

    private function getModel($type)
    {
        switch ($type) {
            case 'pelicula':
                return Pelicula::class;
            case 'serie':
                return Serie::class;
                // Agrega otros casos para modelos adicionales
            default:
                // Lanza una excepción o maneja el error de acuerdo a tus necesidades
                throw new \InvalidArgumentException("Tipo de elemento inválido: $type");
        }
    }
}
