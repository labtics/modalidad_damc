<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
               //PERSONALES
            'name'  => 'min:3|max:80|required',
            'username'  => 'min:3|max:80|required',
             'email' => 'required|unique:users,email',
             'password' => 'required|confirmed'
        ];
    }

    public function messages()
    { 
        return [
            
            'name.required'=>'Tu nombre es obligatorio',
            'username.required'=>'Tu nombre de usuario es obligatorio',
            'email.required'=>'Escribe tu correo electrónico',
            'password'=>'Confirma tu contraseña'
        ];
             
    }
}
