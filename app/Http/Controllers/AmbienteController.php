<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ambiente;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class AmbienteController extends Controller
{
    public function index():JsonResponse
    {
        $usuario = Auth::user();
    
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
    
        $ambientes = Ambiente::where('usuariosede_id', $usuario->id)->get();
       
        return response()->json($ambientes);
    }

    public function store(Request $request):JsonResponse
    {
        $usuario = Auth::user();

        $usuariosede_id = $usuario->id;

        $validarExistencia = Ambiente::where('codigo', $request->codigo)->where('usuariosede_id', $usuario->id)->exists();

        if ($validarExistencia) {
            return response()->json([
                'data' => $validarExistencia,
                'message' => 'La ficha ya existe'
            ], 404);
        }

        $ambienteData = $request->all();
        $ambienteData['usuariosede_id'] = $usuariosede_id;
    
        $ambiente = Ambiente::create($ambienteData);

        return response()->json([
            'Success' => true,
            'data' => $ambiente,
        ], 201);
    }

    public function show($codigo):JsonResponse
    {
        $ambiente = Ambiente::where('codigo', $codigo)->first();

        if (!$ambiente) {
            return response()->json(['message' => 'Ambiente NO encontrado'], 404);
        }

        return response()->json($ambiente, 200);
    }

    public function update(Request $request, $id):JsonResponse
    {
        $ambiente = Ambiente::where('id', $id)->first();

        if (!$ambiente) {
            return response()->json([
                'Success' => false,
                'message' => 'Ambiente NO encontrado'
            ], 404);
        }

        $ambiente->nombre_ambiente = $request->input('nombre_ambiente', $ambiente->nombre_ambiente);
        $ambiente->codigo= $request->input('codigo', $ambiente->codigo);
        $ambiente->save();

        return response()->json([
            'Success' => true,
            'data' => $ambiente
        ]);
    }

    public function destroy( $id):JsonResponse
    {
        $ambiente = Ambiente::where('id', $id)->first();

        if (!$ambiente) {
            return response()->json([
                'Success' => false,
                'message' => 'Ambiente NO encontrado'
            ], 404);
        }

        $ambiente->delete();

        return response()->json([
            'Success' => true,
            'message' => 'Se ha eliminado el ambiente'
        ], 200);
    }
}
