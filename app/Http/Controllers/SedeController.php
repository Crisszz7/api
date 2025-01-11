<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SedeController extends Controller
{

    public function index():JsonResponse
    {
        return response()->json(Sede::all());
    }

    public function store(Request $request):JsonResponse
    {
        $sede = Sede::create($request->all());

        return response()->json([
            'Success' => true,
            'message' => 'Sede creada exitosamente',
            'data' => $sede
        ], 201);
    }

    public function show(String $nombre_sede):JsonResponse
    {
        $sede = Sede::where('nombre_sede', $nombre_sede)->first();

        if (!$sede) {
            return response()->json([
                'Success' => false,
                'message' => 'Sede No encontrada'
                ], 404);
            }

            return response()->json($sede, 200);
        }

    public function update(Request $request, string $nombre_sede):JsonResponse
    {
        $sede = Sede::where('nombre_sede', $nombre_sede)->first();

        if (!$sede) {
            return response()->json([
                'Success' => false,
                'message' => 'Sede NO encontrada'
            ], 404);
        }

        $sede->nombre_sede = $request->input('nombre_sede', $sede->nombre_sede);
        $sede->numero_sede = $request->input('numero_sede', $sede->numero_sede);
        $sede->save();

        return response()->json([
            'Success' => true,
            'message' => 'Sede actualizada exitosamente'
        ], 200);
    }

    public function destroy(string $nombre_sede):JsonResponse
    {
        $sede = Sede::where('nombre_sede', $nombre_sede)->first();

        if (!$sede) {
            return response()->json([
                'Success' => false,
                'message' => 'Sede NO encontrada'
            ], 404);
        }

        $sede->delete();

        return response()->json([
            'Success' => true,
            'message' => 'Sede eliminada exitosamente'
        ], 200);
    }

}
