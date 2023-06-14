<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nombre',
        'email',
        'password',
        'admin',
        'ruta_foto_perfil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Aqui se indican las relaciones entre las diferentes tablas

    public function esAdmin()
    {
        return $this->admin === 1;
    }

    public function peliculasFavoritas()
    {
        return $this->belongsToMany(Pelicula::class, 'pelicula-favorita', 'id_usuario', 'id_pelicula')->withTimestamps();
    }

    public function seriesFavoritas()
    {
        return $this->belongsToMany(Serie::class, 'serie-favorita', 'id_usuario', 'id_serie')->withTimestamps();
    }

    public function watchlist()
    {
        return $this->hasOne(Watchlist::class, 'id_usuario');
    }

    public function peliculasVistas()
    {
        return $this->belongsToMany(Pelicula::class, 'pelicula-vista', 'id_usuario', 'id_pelicula')->withPivot('fecha_visto')->withTimestamps();
    }

    public function seriesVistas()
    {
        return $this->belongsToMany(Serie::class, 'serie-vista', 'id_usuario', 'id_serie')->withPivot('fecha_visto')->withTimestamps();
    }
}
