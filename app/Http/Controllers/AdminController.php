<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Serie;
use App\Models\User;

class AdminController extends Controller
{

    public function panel()
    {
        $usuarios = User::all();

        return view('admin.panel', compact('usuarios'));
    }

    public function refrescarPeliculas(Request $resquest)
    {
        $apiKey = env('TMDB_API_KEY');
        $language = 'es-ES';
        $page = 1;

        if($resquest->number != null){
            $page = $resquest->input('number');
        }

        $url = "https://api.themoviedb.org/3/movie/popular?api_key=$apiKey&language=$language&page=$page";

        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);

        $peliculasData = $data['results'];
        $nuevas = 0;
        // Iterar sobre los datos de las películas
        foreach ($peliculasData as $peliculaData) {
            // Verificar si la película ya existe en la base de datos por su ID
            $existingPelicula = Pelicula::where('id', $peliculaData['id'])->first();
            $generos = $peliculaData['genre_ids']; // Array de IDs de géneros devueltos por la API

            if ($existingPelicula) {
                // Actualizar los datos de la película existente
                $existingPelicula->titulo = $peliculaData['title'];
                $existingPelicula->sinopsis = $peliculaData['overview'];
                $existingPelicula->poster = 'https://image.tmdb.org/t/p/w500' . $peliculaData['poster_path'];
                $existingPelicula->fecha_salida = $peliculaData['release_date'];
                $existingPelicula->popularidad = $peliculaData['popularity'];

                // Actualiza la duración utilizando el ID de la película
                Pelicula::obtenerDuracion($existingPelicula);

                $existingPelicula->generos()->sync($generos);
            } else {
                // Crear una nueva película si no existe
                $pelicula = new Pelicula();
                $pelicula->id = $peliculaData['id'];
                $pelicula->titulo = $peliculaData['title'];
                $pelicula->sinopsis = $peliculaData['overview'];
                $pelicula->poster = 'https://image.tmdb.org/t/p/w500' . $peliculaData['poster_path'];
                $pelicula->fecha_salida = $peliculaData['release_date'];
                $pelicula->popularidad = $peliculaData['popularity'];
                
                Pelicula::obtenerDuracion($pelicula);

                $nuevas++;
                $pelicula->save();
                $pelicula->generos()->sync($generos);
            }
        }

        // Redirigir al panel
        return redirect()->back()->with('exitoPelis', 'Se han añadido ' .$nuevas. ' peliculas nuevas');
    }

    public function refrescarSeries(Request $resquest)
    {
        $apiKey = env('TMDB_API_KEY');
        $language = 'es-ES';
        $page = 1;

        if($resquest->number != null){
            $page = $resquest->input('number');
        }

        $url = "https://api.themoviedb.org/3/tv/popular?api_key=$apiKey&language=$language&page=$page";

        
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody(), true);

        $seriesData = $data['results'];
        $nuevas = 0;
        // Iterar sobre los datos de las series
        foreach ($seriesData as $serieData) {
            // Verificar si la película ya existe en la base de datos por su ID
            $existingserie = Serie::where('id', $serieData['id'])->first();
            $generos = $serieData['genre_ids']; // Array de IDs de géneros devueltos por la API

            if ($existingserie) {
                // Actualizar los datos de la serie existente
                $existingserie->titulo = $serieData['name'];
                $existingserie->sinopsis = $serieData['overview'];
                $existingserie->poster = 'https://image.tmdb.org/t/p/w500' . $serieData['poster_path'];
                $existingserie->fecha_salida = $serieData['first_air_date'];
                $existingserie->popularidad = $serieData['popularity'];

                $existingserie->generos()->sync($generos);
            } else {
                // Crear una nueva serie si no existe
                $serie = new Serie();
                $serie->id = $serieData['id'];
                $serie->titulo = $serieData['name'];
                $serie->sinopsis = $serieData['overview'];
                $serie->poster = 'https://image.tmdb.org/t/p/w500' . $serieData['poster_path'];
                $serie->fecha_salida = $serieData['first_air_date'];
                $serie->popularidad = $serieData['popularity'];

                $nuevas++;
                $serie->save();
                $serie->generos()->sync($generos);
            }
        }

        // Redirigir al panel
        return redirect()->back()->with('exitoSeries', 'Se han añadido ' .$nuevas. ' series nuevas' );
    }
}
