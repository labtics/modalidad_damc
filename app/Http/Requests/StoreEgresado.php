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
            'edad' => 'required|numeric|integer',
            'sexo' => 'required|min:1',
            'estado_civil' => 'required|min:1',
             'email' => 'unique:users,email',
             'telefono' => 'min:10|required|numeric',
             'matricula' => 'required|min:8|',
             'verificarMatri' => 'required|min:8',
             'licenciatura' => 'required|min:1',
             'promedio' => 'required|numeric',
             'actividad_laboral' => 'required|min:1',
             'experiencia' => 'required|min:1'

        ];
    }

    public function messages()
    { 
        return [
            'email.required'=>'Por favor escribe tu correo electrónico',
            'nombre.required'=>'Tu nombre es obligatorio',
            'apellidos'=>'Tu apellido paterno es obligatorio',
            'sexo.required'=>'Elige tu sexo',
            'edad.required'=>'Tu edad es obligatoria',
            'edad.integer'=>'Tu edad debe ser un número entero',
            'edad.numeric'=>'Tu edad debe ser un número',
            'estado_civil.required'=>'Elige un estado civil',
            'telefono.numeric'=>'Tu número de celular debe ser de 10 dígitos',
            'telefono.required'=>'Tu número de celular es obligatorio',
            'matricula.required' => 'Escribe tu matrícula', 
            'verificarMatri.required' => 'Verifica tu matrícula', 
            'licenciatura.required' => 'Elige tu licenciatura', 
            'promedio.required'=>'El promedio es obligatorio',
            'promedio.numeric'=>'El promedio debe ser un número',
            'modalidad_id.required' => 'Elige tu modalidad de titulaciòn',
            'actividad_laboral.required'=>'Elige tu si tienes o no una actividad laboral',
            'experiencia.required'=>'Elige como ha sido tu experiencia en general en la DAMC'
        ];
        
        
    }
}
