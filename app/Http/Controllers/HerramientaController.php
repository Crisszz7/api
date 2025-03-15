<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Herramienta;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class HerramientaController extends Controller
{

    public function index()
    {
        $usuario = Auth::user();
    
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
    
        $herramientas = Herramienta::where('usuariosede_id', $usuario->id)->get();
       
        return response()->json($herramientas);
    }
    
    

    public function store(Request $request):JsonResponse
    {
        $usuario = Auth::user();

        $usuariosede_id = $usuario->id;

        $herramientaData = $request->all();
        $herramientaData['usuariosede_id'] = $usuariosede_id;
    
        $herramienta = Herramienta::create($herramientaData);

        return response()->json([
            'Success' => true,
            'data' => $herramienta,
        ], 201);
    }

    public function show(string $codigo):JsonResponse
    {
        $herramienta = Herramienta::where('codigo', $codigo)->first();

        if (!$herramienta) {
            return response()->json(['message' => 'Herramienta No encontrada'], 404);
        }

        return response()->json( $herramienta, 200);
    }

    public function update(Request $request, $id):JsonResponse
    {
        $herramienta = Herramienta::where('id', $id)->first();

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
        $herramienta->estado_herramienta = $request->input('estado_prestamo', $herramienta->estado_herramienta);
        $herramienta->save();

        return response()->json([
            'Success' => true,
            'message' => 'Herramienta actualizada exitosamente',
            'data' => $herramienta
        ], 200);

    }

    public function destroy($id):JsonResponse
    {
        $herramienta = Herramienta::where('id', $id)->first();

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
