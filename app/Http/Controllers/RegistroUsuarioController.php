<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Models\User;


class RegistroUsuarioController extends Controller
{
    public function store(StoreUser $request)
    {
        $tipo = 'admin';
       User::create([
        'name'=>$request->name,
        'username'=>$request->username,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'tipo'=>$tipo,
       ]);
        return view('auth.login')->with('status','Cuenta Creada');
      
    }
}
