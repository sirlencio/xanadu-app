<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FavoritosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\VistosController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function () {
    Route::get('/',  'index')->name('index');
    Route::get('/buscar/{nombre}', 'buscar')->name('buscar');
    Route::middleware('auth')->get('/configuracion', 'config')->name('configuracion');
});

Route::controller(PeliculasController::class)->group(function () {
    Route::get('/peliculas',  'index')->name('peliculas.index');
    Route::get('/peliculas/{pelicula}', 'show')->name('peliculas.show');
    Route::post('/peliculas/filtrar', 'filtrar')->name('peliculas.filtrar');
});

Route::controller(SeriesController::class)->group(function () {
    Route::get('/series', 'index')->name('series.index');
    Route::get('/series/{serie}', 'show')->name('series.show');
    Route::post('/series/filtrar', 'filtrar')->name('series.filtrar');
});

// Rutas protegidas solo para usuarios autenticados y administradores
Route::controller(AdminController::class)->group(function () {
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/panel', 'panel')->name('admin.panel');
        Route::post('/peliculas/refrescar', 'refrescarPeliculas')->name('refrescar.peliculas');
        Route::post('/series/refrescar', 'refrescarSeries')->name('refrescar.series');        
    });
});

Route::controller(ConfigController::class)->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::post('/perfil/foto', 'cambiarFoto')->name('perfil.cambiarFoto');
        Route::post('/perfil/contrasenia', 'cambiarContrasenia')->name('perfil.cambiarContrasenia');
        Route::post('/perfil/baja', 'darBaja')->name('perfil.darBaja');
        Route::post('/perfil/nombre', 'cambiarNombre')->name('perfil.cambiarNombre');
    });
});

Route::controller(LibrosController::class)->group(function () {
    Route::get('/libros', 'index')->name('libros');
});

Route::controller(RegistroController::class)->group(function () {
    Route::get('/registro', 'index')->name('registro');
    Route::post('/registro', 'registro');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(WatchlistController::class)->group(function () {
    Route::middleware('auth')->post('/watchlist/add/{type}/{id}',  'addToWatchlist')->name('watchlist.add');
    Route::middleware('auth')->post('/watchlist/remove/{type}/{id}', 'removeFromWatchlist')->name('watchlist.remove');
    Route::middleware('auth')->get('/watchlist', 'index')->name('watchlist');
});

Route::controller(FavoritosController::class)->group(function () {
    Route::middleware('auth')->post('/favoritos/add/{type}/{id}',  'addToFavoritos')->name('favoritos.add');
    Route::middleware('auth')->post('/favoritos/remove/{type}/{id}', 'removeFromFavoritos')->name('favoritos.remove');
    Route::middleware('auth')->get('/favoritos', 'index')->name('favoritos');
});

Route::controller(VistosController::class)->group(function () {
    Route::middleware('auth')->post('/vistos/add/{type}/{id}',  'addToVistos')->name('vistos.add');
    Route::middleware('auth')->post('/vistos/remove/{type}/{id}', 'removeFromVistos')->name('vistos.remove');
    Route::middleware('auth')->get('/vistos', 'index')->name('vistos');
});

Route::get('/sobre-nosotros', function () {
    return view('sobre-nosotros');
})->name('sobre-nosotros');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/cargar', function () {
    App\Models\Genero::saveFromApi();
    App\Models\Pelicula::saveFromApi();
    App\Models\Serie::saveFromApi();

    return redirect('/');
});
