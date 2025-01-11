<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ficha;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\FichaRequest;

class FichaController extends Controller
{
    public function index():JsonResponse
    {
        return response()->json(Ficha::all());
    }

    public function store(FichaRequest $request):JsonResponse
    {
        $validarExistencia = Ficha::where('numero_ficha', $request->numero_ficha)->exists();

        if ($validarExistencia) {
            return response()->json([
                'data' => $validarExistencia,
                'message' => 'La ficha ya existe'
            ], 404);
        }

        $ficha = Ficha::create($request->all());

        return response()->json([
            'Success' => true,
            'message' => 'Ficha creada exitosamente',
            'data' => $ficha
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

    public function update(FichaRequest $request, $numero_ficha):JsonResponse
    {
        $ficha = Ficha::where('numero_ficha', $numero_ficha)->first();

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

    public function destroy($numero_ficha):JsonResponse
    {
        $ficha = Ficha::where('numero_ficha', $numero_ficha)->first();

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
