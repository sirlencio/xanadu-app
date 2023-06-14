<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Genero;

class PeliculasController extends Controller
{

    /**
     * Funcion que muestra todas las peliculas de la base de datos
     * 
     * @return view Vista con todas las peliculas, los generos y los años de publicacion
     */
    public function index()
    {
        $peliculas = Pelicula::all();
        $generos = Genero::whereIn('tipo_genero', ['pelicula', 'ambos'])->orderBy('nombre_genero', 'asc')->get();
        $anios = Pelicula::selectRaw('YEAR(fecha_salida) AS anio')->distinct()->pluck('anio');

        return view('peliculas.index')
            ->with('peliculas', $peliculas)
            ->with('generos', $generos)
            ->with('anios', $anios)
            ->with('nombre', "")
            ->with('orden', 'defecto');
    }

    /**
     * Funcion que muestra una pelicula de la base de datos
     * 
     * @param int $pelicula Busca un id de una pelicula y la muestra
     * @return view Vista con la pelicula en cuestión, de no existir muestra un 404
     */
    public function show($pelicula)
    {
        $pelicula = Pelicula::find($pelicula);

        if (!$pelicula) {
            return view('errors.404');
        }

        return view('peliculas.show', compact('pelicula'));
    }

    /**
     * Funcion que muestra las peliculas que coinciden con el genero filtrado
     * 
     * @param Request $request Obtiene los datos del POST (generos, año y orden) y los guarda en un array
     * @return view Vista con las peliculas filtradas y ordenadas
     */
    public function filtrar(Request $request)
    {
        $generoIds = $request->input('generos');
        $anios = $request->input('anio');
        $orden = $request->input('orden');
        $nombre = $request->input('nombre');

        // Filtra las películas según los géneros seleccionados
        $peliculas = Pelicula::query();

        if (!empty($generoIds)) {
            foreach ($generoIds as $generoId) {
                $peliculas->whereHas('generos', function ($query) use ($generoId) {
                    $query->where('id_genero', $generoId);
                });
            }
        }

        // Filtra las películas según los años seleccionados
        if (!empty($anios)) {
            foreach ($anios as $anio) {
                $peliculas->whereYear('fecha_salida', $anio);
            }
        }

        // Filtra las películas según el titulo
        if (!empty($nombre)) {
            $peliculas->where('titulo', 'like', '%' . $nombre . '%');
        }

        // Ordena los resultados
        switch ($orden) {
            case 'nombre':
                $peliculas->orderBy('titulo');
                break;
            case 'fecha':
                $peliculas->orderBy('fecha_salida');
                break;
            case 'popularidad_asc':
                $peliculas->orderBy('popularidad', 'asc');
                break;
            case 'popularidad_desc':
                $peliculas->orderBy('popularidad', 'desc');
                break;
            default:
                $orden = 'defecto';
        }

        $peliculas = $peliculas->get();

        // Vuelve a cargar la misma vista con las películas filtradas
        return view('peliculas.index')
            ->with('peliculas', $peliculas)
            ->with('generos', Genero::all())
            ->with('anios', Pelicula::selectRaw('YEAR(fecha_salida) AS anio')->distinct()->pluck('anio'))
            ->with('orden', $orden)
            ->with('nombre', $nombre);
    }

}
