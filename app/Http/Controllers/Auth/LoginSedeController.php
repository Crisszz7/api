<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UsuarioSede;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginSedeController extends Controller
{   
    public function index(){
        return response()->json(UsuarioSede::with(['sede'])->get());
    }

    public function register(Request $request)
    {

        $request->validate([
            'username' => 'required|string|unique:usuario_sedes,username', 
            'password' => 'required|string',
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
            'password' => Hash::make($request->password), 
            'email' => $request->email,
            'sede_id' => $sede->id, 
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente.',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'emial' => $request->email,
                'sede' => $user->sede->nombre_sede, 
            ],
        ], 201);
    }

    public function show($numero_sede):JsonResponse
    {
        $sede = Sede::where('numero_sede', $numero_sede)->first();

        if (!$sede) {
            return response()->json([
                'Success' => false,
                'message' => 'Sede No encontrada',
                ], 404);
            }

        $sedeUsuario = UsuarioSede::with(['sede'])->where('sede_id', $sede->id)->first();

            return response()->json($sedeUsuario, 200);
        }

    public function update(Request $request, $id):JsonResponse
    {
        $usuario = Auth::user();
        $usuarioSede = UsuarioSede::where('id', $id)->first();

        if (!$usuarioSede) {
            return response()->json([
                'message' => 'Hay un error en los datos, verificalos',
                'data' => $usuarioSede,
            ], 400);
        }

        ($sedeUsuarioActualizar = UsuarioSede::where('sede_id', $usuarioSede->sede_id)->first());

        $sedeUsuarioActualizar->username = $request->input('username', $sedeUsuarioActualizar->username);
        $sedeUsuarioActualizar->email = $request->input('email', $sedeUsuarioActualizar->email);
        $sedeUsuarioActualizar->password = Hash::make($request->input('password', $sedeUsuarioActualizar->password));
        $sedeUsuarioActualizar->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario de sede Actualizado',
            'data' => $sedeUsuarioActualizar,
        ], 200);

    }

    public function destroy($id):JsonResponse
    {

        $usuario = Auth::user();
        $usuarioSede = UsuarioSede::where('id', $id)->first();

        if (!$usuarioSede) {
            return response()->json([
                'message' => 'Sede no encontrada',
                'data' => $usuarioSede,
            ], 400);
        }

        $sedeUsuarioEliminar = UsuarioSede::where('sede_id', $usuarioSede->sede_id)->first();

        $sedeUsuarioEliminar->delete();

        return response()->json([
            'message' => 'Usuario de Sede eliminado exitosamente.',
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'contrasena' => 'required|string',
        ]);
    
        $user = UsuarioSede::where('username', $request->username)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas.'], 401);
        }
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'message' => 'Inicio de sesión exitoso.',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'sede' => $user->sede->nombre_sede ?? null,
            ],
        ], 200);
    }
    

    public function logout(Request $request)
    {
        $user = $request->user();
    
        if ($user) {
            $user->tokens()->delete(); 
        }
    
        return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
    }

}

