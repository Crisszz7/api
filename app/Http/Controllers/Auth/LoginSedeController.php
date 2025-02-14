<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UsuarioSede;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginSedeController extends Controller
{

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

    public function update(Request $request, $numero_sede):JsonResponse{

        $sede = Sede::where('numero_sede', $numero_sede)->first();

        if (!$sede) {
            return response()->json([
                'message' => 'Sede no encontrada',
                'data' => $sede,
            ], 400);
        }

        $sedeUsuarioActualizar = UsuarioSede::where('sede_id', $sede->id)->first();

        $sedeUsuarioActualizar->username = $request->input('username', $sedeUsuarioActualizar->username);
        $sedeUsuarioActualizar->contrasena = Hash::make($request->input('contrasena', $sedeUsuarioActualizar->contrasena));
        $sedeUsuarioActualizar->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario de sede Actualizado',
            'data' => $sedeUsuarioActualizar,
        ], 200);

    }

    public function destroy($numero_sede):JsonResponse
    {

        $sede = Sede::where('numero_sede', $numero_sede)->first();

        if (!$sede) {
            return response()->json([
                'message' => 'Sede no encontrada',
                'data' => $sede,
            ], 400);
        }

        $sedeUsuarioEliminar = UsuarioSede::where('sede_id', $sede->id)->first();

        $sedeUsuarioEliminar->delete();

        return response()->json([
            'message' => 'Usuario de Sede eliminado exitosamente.',
        ], 200);
    }
    
    public function logout(Request $request)
    {
        Auth::guard('usuario_sede')->logout();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.',
        ], 200);
    }
}

