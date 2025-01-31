<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rol;
use Illuminate\Http\JsonResponse;

class RolController extends Controller
{

    public function index():JsonResponse
    {
        return response()->json(Rol::all());
    }

    public function store(Request $request):JsonResponse
    {
        $rol = Rol::create($request->all());
        return response()->json([
            'Exito' => true,
            'Datos Rol' => $rol
        ], 200);
    }

    public function show(string $tipo):JsonResponse
    {
        $rol = Rol::find($tipo);

            return response()->json([
                'Success' => true,
                'Datos Rol' => $rol
            ], 200);
        }

        public function update(Request $request, $tipo):JsonResponse
        {
            $rol = Rol::where('tipo', $tipo)->first();
    
            if (!$rol) {
                return response()->json([
                    'Success' => false,
                    'message' => 'Rol NO encontrado'
                ], 404);
            }
    
            $rol->tipo = $request->input('tipo', $tipo->tipo);
            $rol->save();
    
            return response()->json([
                'Success' => true,
                'data' => $rol
            ]);
        }


        public function destroy($tipo):JsonResponse
        {
            $rol = Rol::where('tipo', $tipo)->first();
    
            if (!$rol) {
                return response()->json([
                    'Success' => false,
                    'message' => 'Rol NO encontrado'
                ], 404);
            }
    
            $rol->delete();
    
            return response()->json([
                'Success' => true,
                'message' => 'Se ha eliminado el rol'
            ], 200);
        }


    }

