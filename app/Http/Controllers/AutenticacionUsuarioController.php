<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SesionUser;
use Illuminate\Support\Facades\Auth;

class AutenticacionUsuarioController extends Controller
{
    public function store(SesionUser $request)
    {
        
        $credentials = $request->only('email', 'password');

    // Verifica si las credenciales son válidas y autentica al usuario
    if (Auth::attempt($credentials)) {
        // Si las credenciales son válidas, redirige al usuario a la página principal
        return redirect()->intended('/modalidad/admin/panel');
    } else {
        // Si las credenciales no son válidas, redirige al usuario a la página de inicio de sesión con un mensaje de error
        return redirect()->route('login')->withErrors(['error' => 'Las credenciales no son válidas.']);
    }
        

    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login')->with('status', 'Haz finalizado tu sesión');
    }
}
