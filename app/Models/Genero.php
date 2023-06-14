<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre_genero',
        'tipo_genero'
    ];

    public static function getFromApi($url)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);

        return $data['genres'];
    }

    public static function saveFromApi()
    {
        $apiKey = env('TMDB_API_KEY');
        $language = 'es-ES';
        $url1 = "https://api.themoviedb.org/3/genre/movie/list?api_key=$apiKey&language=$language";
        $url2 = "https://api.themoviedb.org/3/genre/tv/list?api_key=$apiKey&language=$language";
        $urls = [$url1, $url2];

        foreach ($urls as $url) {
            $generos = self::getFromApi($url);

            foreach ($generos as $genero) {
                $existe = self::where('id', $genero['id'])->first();

                if ($existe) {
                    $existe->tipo_genero = 'ambos';
                    $existe->save();
                } else {
                    self::create([
                        'id' => $genero['id'],
                        'nombre_genero' => $genero['name'],
                        'tipo_genero' => str_contains($url, '/genre/movie/') ? 'pelicula' : 'serie'
                    ]);
                }
            }
        }
    }

    //Aqui se indican las relaciones entre las diferentes tablas

    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'pelicula-genero', 'id_genero', 'id_pelicula')->withTimestamps();
    }

    public function series()
    {
        return $this->belongsToMany(Serie::class, 'pelicula-genero', 'id_genero', 'id_serie')->withTimestamps();
    }
}
