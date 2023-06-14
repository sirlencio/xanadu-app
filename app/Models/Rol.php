<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';


    //Aqui se indican las relaciones entre las diferentes tablas

    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'pelicula-elenco', 'id_rol', 'id_pelicula')->withPivot('id_persona')->withTimestamps();
    }

    public function series()
    {
        return $this->belongsToMany(Serie::class, 'serie-elenco', 'id_rol', 'id_serie')->withPivot('id_persona')->withTimestamps();
    }
}
