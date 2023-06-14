<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\RequestException;

class Pelicula extends Model
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
        'popularidad',
        'duracion'
    ];

    public static function getFromApi()
    {
        $apiKey = env('TMDB_API_KEY');
        $language = 'es_ES';
        $url = "https://api.themoviedb.org/3/movie/popular?api_key=$apiKey&language=$language";

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);

        return $data['results'];
    }

    public static function saveFromApi()
    {
        $peliculas = self::getFromApi();

        foreach ($peliculas as $pelicula) {
            $generos = $pelicula['genre_ids']; // Array de IDs de géneros devueltos por la API

            $nuevaPelicula = new Pelicula();
            $nuevaPelicula->fill([
                'id' => $pelicula['id'], 
                'titulo' => $pelicula['title'],
                'sinopsis' => $pelicula['overview'],
                'poster' => 'https://image.tmdb.org/t/p/w500' . $pelicula['poster_path'],
                'fecha_salida' => $pelicula['release_date'],
                'popularidad' => $pelicula['popularity']
            ]);
            $nuevaPelicula->save();

            // Actualiza la duración utilizando el ID de la película
            self::obtenerDuracion($nuevaPelicula);

            $nuevaPelicula->generos()->sync($generos); //Al crear la pelicula se le vinculan los generos
        }
    }

    public static function obtenerDuracion(Pelicula $pelicula)
    {
        $peliculaId = $pelicula->id;

        // Configura y realiza la solicitud a la otra fuente de datos para obtener la duración de la película por ID
        $apiKey = env('TMDB_API_KEY');
        $language = 'es-ES';
        $url = "https://api.themoviedb.org/3/movie/$peliculaId?api_key=$apiKey&language=$language";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            $duracion = $data['runtime'];

            // Actualiza el modelo Pelicula con la duración obtenida
            $pelicula->duracion = $duracion;
            $pelicula->save();
        } catch (RequestException $e) {
            // Maneja cualquier error de solicitud o respuesta de la API
            // Puedes devolver un valor predeterminado o lanzar una excepción según tus necesidades
            $pelicula->duracion = 0; // Valor predeterminado en caso de error
            $pelicula->save();
        }
    }

    //Aqui se indican las relaciones entre las diferentes tablas

    public function watchlists()
    {
        return $this->belongsToMany(Watchlist::class, 'pelicula-watchlist', 'id_pelicula', 'id_watchlist')->withTimestamps();
    }

    public function usuariosQueDieronFav()
    {
        return $this->belongsToMany(User::class, 'pelicula-favorita', 'id_pelicula', 'id_usuario')->withTimestamps();
    }

    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'pelicula-genero', 'id_pelicula', 'id_genero')->withTimestamps();
    }
        
    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'pelicula-elenco', 'id_pelicula', 'id_persona')->withPivot('id_rol')->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'pelicula-elenco', 'id_pelicula', 'id_rol')->withPivot('id_persona')->withTimestamps();
    }

    public function usuariosQueHanVisto()
    {
        return $this->belongsToMany(User::class, 'pelicula-vista', 'id_pelicula', 'id_usuario')->withPivot('fecha_visto')->withTimestamps();
    }
}
