<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Historial;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $historiales = Historial::with(['usuario', 'prestamo'])
        ->where('usuariosede_id', $usuario->id)
        ->get();

        return response()->json([
            'success' => true,
            'data' => $historiales
        ], 200);
    }

    public function show($identificacion):JsonResponse
    {
        $usuario = Usuario::where('identificacion', $identificacion)->first();

        
    if (!$usuario) {
        return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
    }

        $historial = $usuario->historials()->where('estado', 'activo')->orWhere('estado', 'devuelto')->first();

        return response()->json([
            'success' => true,
            'data' => $historial
        ], 200);
    }

    // public function destroy ($id):JsonResponse{

    //     // $historial = Historial::where('id', $id)->first();

    //     // if (!$historial) {
    //     //     return response()->json([
    //     //         'Success' => false,
    //     //         'message' => 'Ocurrio un error'
    //     //     ], 404);
    //     // }

    //     // $historial->delete();
    // }

}
