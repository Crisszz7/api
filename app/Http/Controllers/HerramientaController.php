<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\HerramientaRequest;
use App\Models\Herramienta;
use Illuminate\Http\JsonResponse;

class HerramientaController extends Controller
{
    public function index():JsonResponse
    {
        return response()->json(Herramienta::all(), 200);
    }

    public function store(HerramientaRequest $request):JsonResponse
    {
        $herramienta = Herramienta::create($request->all());

        return response()->json([
            'Success' => true,
            'data' => $herramienta
        ], 201);
    }

    public function show(string $codigo):JsonResponse
    {
        $herramienta = Herramienta::where('codigo', $codigo)->first();

        if (!$herramienta) {
            return response()->json(['message' => 'Herramienta No encontrada'], 404);
        }

        return response()->json($herramienta, 200);
    }

    public function update(HerramientaRequest $request,string $codigo):JsonResponse
    {
        $herramienta = Herramienta::where('codigo', $codigo)->first();

        if (!$herramienta) {
            return response()->json([
                'Success' => false,
                'message' => 'Herramienta NO encontrada'
            ], 404);
        }

        $herramienta->nombre_herramienta = $request->input('nombre_herramienta', $herramienta->nombre_herramienta);
        $herramienta->codigo = $request->input('codigo', $herramienta->codigo);
        $herramienta->stock = $request->input('stock', $herramienta->stock);
        $herramienta->ubicacion = $request->input('ubicacion', $herramienta->ubicacion);
        $herramienta->save();

        return response()->json([
            'Success' => true,
            'message' => 'Herramienta actualizada exitosamente',
            'data' => $herramienta
        ], 200);

    }

    public function destroy(string $codigo):JsonResponse
    {
        $herramienta = Herramienta::where('codigo', $codigo)->first();

        if (!$herramienta) {
            return response()->json([
                'Success' => false,
                'message' => 'Herramienta NO encontrada'
            ], 404);
        }

        $herramienta->delete();
        
        return response()->json([
            'Success' => true,
            'message' => 'Herramienta eliminada exitosamente'
        ], 200);
    }
}
