<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AmbienteRequest;
use App\Models\Ambiente;
use Illuminate\Http\JsonResponse;


class AmbienteController extends Controller
{
    public function index():JsonResponse
    {
        return response()->json(Ambiente::all());
    }

    public function store(AmbienteRequest $request):JsonResponse
    {
        $ambiente = Ambiente::create($request->all());

        return response()->json([
            'Success' => true,
            'message' => 'Ambiente creado exitosamente',
            'data' => $ambiente
        ], 201);
    }

    public function show(string $codigo):JsonResponse
    {
        $ambiente = Ambiente::where('codigo', $codigo)->first();

        if (!$ambiente) {
            return response()->json(['message' => 'Ambiente NO encontrado'], 404);
        }

        return response()->json($ambiente, 200);
    }

    public function update(AmbienteRequest $request, string $codigo):JsonResponse
    {
        $ambiente = Ambiente::where('codigo', $codigo)->first();

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

    public function destroy(string $codigo):JsonResponse
    {
        $ambiente = Ambiente::where('codigo', $codigo)->first();

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
