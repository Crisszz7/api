<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario ;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index():JsonResponse
    {
        return response()->json(Usuario::with(['ficha', 'rol'])->get());
    }

    public function store(UsuarioRequest $request):JsonResponse
    {
        $validarIdentificacion = Usuario::where('identificacion', $request->identificacion)->exists();

        if ($validarIdentificacion) {
            return response()->json(['message' => 'Ya existe la identificacion'], 404);
        }

        $usuario = Usuario::create($request->all());

        return response()->json([
            'Success' => true,
            'data' => $usuario
        ], 201);
    }

    public function show($identificacion):JsonResponse
    {
        $usuario = Usuario::with(['rol', 'ficha'])->where('identificacion', $identificacion)->first();

        if (!$usuario) {
            return response()->json(['message' => 'Usuario NO encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }

    public function update(Request $request, $id):JsonResponse
    {
        $usuario = Usuario::where('id', $id)->first();

        if (!$usuario) {
            return response()->json([
                'Success' => false,
                'message' => 'Usuario NO encontrado'
            ], 404);
        }

        $usuario->nombre = $request->input('nombre', $usuario->nombre);
        $usuario->apellido = $request->input('apellido', $usuario->apellido);
        $usuario->identificacion = $request->input('identificacion', $usuario->identificacion);
        $usuario->celular = $request->input('celular', $usuario->celular);
        $usuario->save();

        return response()->json([
            'Success' => true,
            'data' => $usuario
        ]);
    }

    public function destroy($id):JsonResponse
    {
        $usuario = Usuario::where('id', $id)->first();

        if (!$usuario) {
            return response()->json([
                'Success' => false,
                'message' => 'Usuario NO encontrado'
            ], 404);
        }

        $usuario->delete();

        return response()->json([
            'Success' => true,
            'message' => 'Se ha eliminado el usuario'
        ], 200);
    }
}
