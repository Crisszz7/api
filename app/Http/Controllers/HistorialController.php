<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Historial;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index()
    {
        $historiales = Historial::with(['usuario', 'prestamo'])->get();

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


}
