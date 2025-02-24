<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['correo' => 'required|email']);
    
        $status = Password::sendResetLink(['correo' => $request->correo]);
    
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Se ha enviado el enlace de restablecimiento de contraseña.'], 200);
        }
    
        return response()->json(['message' => 'No se pudo enviar el enlace de restablecimiento.'], 400);
    }
    
}
