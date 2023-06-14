<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;


    //Aqui se indican las relaciones entre las diferentes tablas

    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'pelicula-elenco', 'id_persona', 'id_pelicula')->withPivot('id_rol')->withTimestamps();
    }

    public function series()
    {
        return $this->belongsToMany(Serie::class, 'serie-elenco', 'id_persona', 'id_serie')->withPivot('id_rol')->withTimestamps();
    }
}
