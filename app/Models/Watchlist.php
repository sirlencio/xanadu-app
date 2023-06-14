<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;


    //Aqui se indican las relaciones entre las diferentes tablas
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'pelicula-watchlist', 'id_watchlist', 'id_pelicula')->withTimestamps();
    }

    public function series()
    {
        return $this->belongsToMany(Serie::class, 'serie-watchlist', 'id_watchlist', 'id_serie')->withTimestamps();
    }
}
