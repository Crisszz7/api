<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ficha;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FichaController extends Controller
{
    public function index():JsonResponse
    {
        $usuario = Auth::user();
    
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
    
        $fichas = Ficha::where('usuariosede_id', $usuario->id)->get();
       
        return response()->json($fichas);
    }

    public function store(Request $request):JsonResponse
    {

        $usuario = Auth::user();

        $usuariosede_id = $usuario->id;

        $validarExistencia = Ficha::where('numero_ficha', $request->numero_ficha)->exists();

        if ($validarExistencia) {
            return response()->json([
                'data' => $validarExistencia,
                'message' => 'La ficha ya existe'
            ], 404);
        }

        $fichaData = $request->all();
        $fichaData['usuariosede_id'] = $usuariosede_id;
    
        $fichaData = Ficha::create($fichaData);

        return response()->json([
            'Success' => true,
            'data' => $fichaData,
        ], 201);
    }

 
    public function show($numero_ficha):JsonResponse
    {
        $ficha = Ficha::where('numero_ficha', $numero_ficha)->first() ;

        if (!$ficha) {
            return response()->json([
                'Success' => false,
                'message' => 'Ficha No Encontrada'
            ], 404);
        }

        return response()->json([
            'Success' => true,
            'data' =>  $ficha
        ], 200);

    }

    public function update(Request $request, $id):JsonResponse
    {
        $ficha = Ficha::where('id', $id)->first();

        if (!$ficha) {
            return response()->json([
                'Success' => false,
                'message' => 'Ficha NO encontrada'
            ], 404);
        }

        $ficha->nombre_ficha = $request->input('nombre_ficha', $ficha->nombre_ficha);
        $ficha->numero_ficha = $request->input('numero_ficha', $ficha->numero_ficha);
        $ficha->save();

        return response()->json([
            'Success' => true,
            'message' => 'Ficha actualizada exitosamente',
            'data' => $ficha
        ], 200);
    }

    public function destroy($id):JsonResponse
    {
        $ficha = Ficha::where('id', $id)->first();

        if (!$ficha) {
            return response()->json([
                'Success' => false,
                'message' => 'Ficha NO encontrada'
            ], 404);
        }

        Usuario::where('ficha_id', $ficha->id)->update(['ficha_id' => null]);

        $ficha->delete();

        return response()->json([
            'Success' => true,
            'message' => 'Ficha Eliminada y Usuarios Actualizados'
        ], 200);
    }
}
