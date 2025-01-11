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

    public function show(string $id):JsonResponse
    {
        $rol = Rol::find($id);

            return response()->json([
                'Success' => true,
                'Datos Rol' => $rol
            ], 200);
        }
    }

