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
        $validarExistencia = Sede::where('numero_sede', $request->numero_sede)->first();

        if ($validarExistencia) {
            return response()->json(['message' => 'Ya existe una sede con sede con ese numero']);
        }

        $sede = Sede::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Sede creada exitosamente',
            'data' => $sede
        ], 201);
    }

    public function show(String $nombre_sede):JsonResponse
    {
        $sede = Sede::where('nombre_sede', $nombre_sede)->first();

        if (!$sede) {
            return response()->json([
                'success' => false,
                'message' => 'Sede No encontrada'
                ], 404);
            }

            return response()->json($sede, 200);
        }

    public function update(Request $request, $id):JsonResponse
    {
        $sede = Sede::where('id', $id)->first();

        if (!$sede) {
            return response()->json([
                'success' => false,
                'message' => 'Sede NO encontrada'
            ], 404);
        }

        $sede->nombre_sede = $request->input('nombre_sede', $sede->nombre_sede);
        $sede->numero_sede = $request->input('numero_sede', $sede->numero_sede);
        $sede->estado = $request->input('estado', $sede->estado);
        $sede->save();

        return response()->json([
            'Success' => true,
            'message' => 'Sede actualizada exitosamente'
        ], 200);
    }

    public function destroy($id):JsonResponse
    {
        $sede = Sede::where('id', $id)->first();

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
