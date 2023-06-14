<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{

    public function cambiarNombre(Request $request)
    {
        $user = auth()->user();
        $usuario = User::find($user->id);

        $request->validate([
            'name' => 'required|string',
        ]);
        // Actualizar la contraseña en la base de datos
        $usuario->nombre = $request->name;

        $usuario->save();

        return redirect()->back()->with('exitoNombre', 'Nombre cambiado exitosamente');
    }

    public function cambiarContrasenia(Request $request)
    {
        $user = auth()->user();
        $usuario = User::find($user->id);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Verificar si la contraseña actual ingresada coincide con la contraseña almacenada en la base de datos
        if (!Hash::check($request->current_password, $usuario->password)) {
            return redirect()->back()->with('error', 'La contraseña actual no es válida');
        }

        // Generar un nuevo hash para la nueva contraseña
        $newPasswordHash = Hash::make($request->new_password);

        // Actualizar la contraseña en la base de datos
        $usuario->password = $newPasswordHash;

        $usuario->save();

        return redirect()->back()->with('exitoContra', 'Contraseña cambiada exitosamente');
    }

    public function darBaja(Request $request)
    {
        $user = auth()->user();
        $usuario = User::find($user->id);
        $password = $request->input('password');

        if (Hash::check($password, $user->password)) {
            // Borrar cuenta y realizar cualquier otra acción necesaria
            $usuario->delete();

            // Cerrar la sesión del usuario
            Auth::logout();

            // Redirigir a una página de confirmación o a la página de inicio
            return redirect()->route('index')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
        } else {
            // Contraseña incorrecta, mostrar mensaje de error
            return redirect()->back()->with('seguridad', 'La contraseña ingresada es incorrecta. Por favor, intenta nuevamente.');
        }
    }

    public function cambiarFoto(Request $request)
    {
        $request->validate([
            'subida' => 'image|mimes:jpeg,png,jpg,gif|max:2048|required',
        ]);

        if ($request->hasFile('subida')) {
            $user = auth()->user();
            $usuario = User::find($user->id);

            // Eliminar foto de perfil anterior, si existe
            if ($usuario->ruta_foto_perfil != 'default.png' && $usuario->ruta_foto_perfil != 'administrador.png' && $usuario->ruta_foto_perfil) {
                Storage::delete('public/images/' . $usuario->ruta_foto_perfil);
            }

            $rutaFotoPerfil = $request->file('subida')->store('images', 'public');

            // El substring es necesario porque la ruta guardada es images/(nombrefoto)
            $usuario->ruta_foto_perfil = substr($rutaFotoPerfil, 7);

            $usuario->save();
        }

        // Resto de la lógica de actualización de la configuración...

        return redirect()->back()->with('exitoFoto', 'La foto de perfil se ha actualizado correctamente.');
    }
}
