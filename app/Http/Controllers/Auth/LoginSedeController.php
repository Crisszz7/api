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

        $user->contrasena = trim($user->contrasena);  

    
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

        $request->validate([
            'username' => 'required|string|unique:usuario_sedes,username', 
            'contrasena' => 'required|string',
            'numero_sede' => 'required|exists:sedes,numero_sede', 
        ]);

  
        $sede = Sede::where('numero_sede', $request->numero_sede)->first();

        if (!$sede) {
            return response()->json([
                'message' => 'Sede no encontrada.',
            ], 400);
        }

        $user = UsuarioSede::create([
            'username' => $request->username,
            'contrasena' => Hash::make($request->contrasena), 
            'sede_id' => $sede->id, 
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente.',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'sede' => $user->sede->nombre_sede, 
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

