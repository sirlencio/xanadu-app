<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'titulo',
        'sinopsis',
        'poster',
        'fecha_salida',
        'popularidad'
    ];


    public static function getFromApi()
    {
        $apiKey = env('TMDB_API_KEY');
        $language = 'es-ES';
        $url = "https://api.themoviedb.org/3/tv/popular?api_key=$apiKey&language=$language";

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);

        return $data['results'];
    }

    public static function saveFromApi()
    {
        $series = self::getFromApi();

        foreach ($series as $serie) {
            $generos = $serie['genre_ids'];
            
            $nuevaSerie = self::updateOrCreate([
                'id' => $serie['id'], 
                'titulo' => $serie['name'],
                'sinopsis' => $serie['overview'],
                'poster' => 'https://image.tmdb.org/t/p/w500' . $serie['poster_path'],
                'fecha_salida' => $serie['first_air_date'],
                'popularidad' => $serie['popularity']
            ]);

            $nuevaSerie->generos()->sync($generos);
        }
    }

    //Aqui se indican las relaciones entre las diferentes tablas

    public function usuariosQueDieronFav()
    {
        return $this->belongsToMany(User::class, 'serie-favorita', 'id_serie', 'id_usuario')->withTimestamps();
    }

    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'serie-genero', 'id_serie', 'id_genero')->withTimestamps();
    }

    public function watchlists()
    {
        return $this->belongsToMany(Watchlist::class, 'serie-watchlist', 'id_serie', 'id_watchlist')->withTimestamps();
    }

    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'serie-elenco', 'id_serie', 'id_persona')->withPivot('id_rol')->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'serie-elenco', 'id_serie', 'id_rol')->withPivot('id_persona')->withTimestamps();
    }

    public function usuariosQueHanVisto()
    {
        return $this->belongsToMany(User::class, 'serie-vista', 'id_serie', 'id_usuario')->withPivot('fecha_visto')->withTimestamps();
    }
}
