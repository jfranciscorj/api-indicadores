<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'rol' => 'required'
        ];
    }

    public function attributes(){
        return[
            'name' => 'Nombre',
            'email' => 'Correo electrónico',
            'rol' => 'Rol'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Debe ingresar un nombre, es obligatorio',
            'name.max' => 'Solo se permiten 50 caracteres',
            'email.required' => 'Debe ingresar un correo electrónico, es obligatorio',
            'email.email' => 'Debe ingresar un correo electrónico valido',
            'email.max' => 'Solo se permiten 50 caracteres',
            'rol.required' => 'Debe seleccionar un rol, es obligatorio',
        ];
    }
}
