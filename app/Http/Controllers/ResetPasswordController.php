<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UsuarioSede;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function reset(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);


        $status = Password::broker('usuarios_sedes')->reset(
            $request->only('email', 'password', 'token'), 
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password), 
                ])->save();
    
                event(new PasswordReset($user)); // Dispara el evento de restablecimiento de contraseña
    
            }
        );
    
        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'message' => 'La contraseña fue reestablecida',
                'login' => url('/api/login-sede'),
            ], 200);
        }
    
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
    public function showResetForm($token, Request $request) {
        return view('mails.messageReceived', [
            'token' => $token,
            'email' => $request->query('email') ?? 'Sin email',
        ]);
    }
}
