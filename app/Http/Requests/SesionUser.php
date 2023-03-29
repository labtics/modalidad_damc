<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SesionUser extends FormRequest
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
        
             'email' => 'required',
             'password' => 'required'
        ];
    }

    public function messages()
    { 
        return [
            
            'email.required'=>'Escribe tu correo electrónico',
            'password'=>'Escribe tu contraseña'
        ];
             
    }
}
