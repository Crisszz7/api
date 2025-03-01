<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UsuarioSede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request){
        $request->validate(['email' => 'required|email']);

        // dd($request->email);

        $correoUsuario = UsuarioSede::where('email', $request->email);

        if (!$correoUsuario) {
            return  response()->json(['message' => 'No se encontro el correo, verificalo por favor']);
        }
        // En Laravel, el broker de contraseñas define qué modelo de usuario se usará para recuperar contraseñas
        $estado = Password::broker('usuarios_sedes')->sendResetLink(['email' => $request->email]);

        if($estado === Password::RESET_LINK_SENT){
            return response()->json(['message' => 'Se ha enviado el link de restablecimiento'], 200);
        }

        throw ValidationException::withMessages([
            'email' => [trans($estado)],
        ]);

    }
}
