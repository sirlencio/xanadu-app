<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\Genero;

class SeriesController extends Controller
{

    public function index()
    {
        $series = Serie::all();
        $generos = Genero::whereIn('tipo_genero', ['serie', 'ambos'])->orderBy('nombre_genero', 'asc')->get();
        $anios = Serie::selectRaw('YEAR(fecha_salida) AS anio')->distinct()->pluck('anio');

        return view('series.index')
            ->with('series', $series)
            ->with('generos', $generos)
            ->with('anios', $anios)
            ->with('nombre', "")
            ->with('orden', 'defecto');
    }


    public function show($serie)
    {
        $serie = Serie::find($serie);

        if (!$serie) {
            return view('errors.404');
        }

        return view('series.show', compact('serie'));
    }

    /**
     * Funcion que muestra las series que coinciden con el genero filtrado
     * 
     * @param Request $request Obtiene los datos del POST (generos, año y orden) y los guarda en un array
     * @return view Vista con las series filtradas y ordenadas
     */
    public function filtrar(Request $request)
    {
        $generoIds = $request->input('generos');
        $anios = $request->input('anio');
        $orden = $request->input('orden');
        $nombre = $request->input('nombre');

        // Filtra las series según los géneros seleccionados
        $series = Serie::query();

        if (!empty($generoIds)) {
            foreach ($generoIds as $generoId) {
                $series->whereHas('generos', function ($query) use ($generoId) {
                    $query->where('id_genero', $generoId);
                });
            }
        }

        // Filtra las series según los años seleccionados
        if (!empty($anios)) {
            foreach ($anios as $anio) {
                $series->whereYear('fecha_salida', $anio);
            }
        }

        // Filtra las películas según el titulo
        if (!empty($nombre)) {
            $series->where('titulo', 'like', '%' . $nombre . '%');
        }

        // Ordena los resultados
        switch ($orden) {
            case 'nombre':
                $series->orderBy('titulo');
                break;
            case 'fecha':
                $series->orderBy('fecha_salida');
                break;
            case 'popularidad_asc':
                $series->orderBy('popularidad', 'asc');
                break;
            case 'popularidad_desc':
                $series->orderBy('popularidad', 'desc');
                break;
            default:
                // Ordenar por defecto si no se especifica un tipo de orden válido
                $series->orderBy('id', 'desc');
        }

        $series = $series->get();

        // Vuelve a cargar la misma vista con las series filtradas
        return view('series.index')
            ->with('series', $series)
            ->with('generos', Genero::all())
            ->with('anios', Serie::selectRaw('YEAR(fecha_salida) AS anio')->distinct()->pluck('anio'))
            ->with('orden', $orden)
            ->with('nombre', $nombre);
    }

    
}
