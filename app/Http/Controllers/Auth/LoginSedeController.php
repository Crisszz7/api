<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UsuarioSede;
use Illuminate\Support\Facades\Hash;

class LoginSedeController extends Controller
{
    public function showLoginForm()
    {
        return response()->json([
            'message' => 'Accede a esta ruta enviando las credenciales por POST.',
            'required_fields' => ['username', 'contrasena']
        ], 200);
    }



    public function login(Request $request)
    {
        $user = UsuarioSede::where('username', $request->username)->first();
        
        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado.',
            ], 401);
        }

        $user->contrasena = trim($user->contrasena);  // Eliminar espacios

    
        if (Hash::check($request->contrasena, $user->contrasena)) {
            return response()->json([
                'message' => 'Inicio de sesión exitoso.',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'sede' => $user->sede->nombre_sede,
                ],
            ], 200);
        }
    
        return response()->json([
            'message' => 'Credenciales incorrectas.',
        ], 401);
    }
    

    public function register(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'username' => 'required|string|unique:usuario_sedes,username', // Asegúrate de que el nombre de usuario sea único
            'contrasena' => 'required|string', // Contraseña mínima de 6 caracteres
            'numero_sede' => 'required|exists:sedes,numero_sede', // Validar que el numero_sede exista en la tabla Sedes
        ]);

        // Buscar la sede con el numero_sede proporcionado
        $sede = Sede::where('numero_sede', $request->numero_sede)->first();

        if (!$sede) {
            return response()->json([
                'message' => 'Sede no encontrada.',
            ], 400);
        }

        $user = UsuarioSede::create([
            'username' => $request->username,
            'contrasena' => Hash::make($request->contrasena), // Cifrar la contraseña
            'sede_id' => $sede->id, // Relacionar con la sede
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente.',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'sede' => $user->sede->nombre_sede, // Incluyendo la sede
            ],
        ], 201);
    }
    
    public function logout(Request $request)
    {
        Auth::guard('usuario_sede')->logout();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.',
        ], 200);
    }
}

