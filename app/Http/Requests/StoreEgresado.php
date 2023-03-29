<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEgresado extends FormRequest
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
            'nombre'  => 'min:3|max:30|required',
            'apellidos' => 'min:3|max:30|required',
            'sexo' => 'required|min:1',
             'edad' => 'required|numeric',
             'email' => 'unique:users,email',
             'telefono' => 'min:10|required|numeric',
             'matricula' => 'required|min:8|',
             'verificarMatri' => 'required|min:8',
             'licenciatura' => 'required|min:1',
             'modalidad_id' => 'required|min:1'
        ];
    }

    public function messages()
    { 
        return [
            'email.required'=>'Escribe tu correo electrónico',
            'nombre.required'=>'Tu nombre es obligatorio',
            'apellidos'=>'Tu apellido paterno es obligatorio',
            'sexo.required'=>'Elige tu sexo',
            'edad.required'=>'Tu edad es obligatoria',
            'edad.numeric'=>'Tu edad debe ser un número',
            'telefono.numeric'=>'Tu número de celular debe ser de 10 dígitos',
            'telefono.required'=>'Tu número de celular es obligatorio',
            'matricula.required' => 'Escribe tu matrícula', 
            'verificarMatri.required' => 'Verifica tu matrícula', 
            'licenciatura.required' => 'Elige tu licenciatura', 
            'modalidad_id.required' => 'Elige tu modalidad de titulaciòn'
        ];
        
        
    }
}
