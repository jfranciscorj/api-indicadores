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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email|max:50',
            'password' => 'required|min:8|max:50',
            'password_confirmation' => 'required|min:8|max:50|same:password',
            'rol' => 'required'
        ];
    }

    public function attributes(){
        return[
            'name' => 'Nombre',
            'email' => 'Correo electrónico',
            'rol' => 'Rol',
            'password' => 'Clave',
            'password_confirmation' => 'Confirme clave',
            'rol' => 'Rol',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Debe ingresar un nombre, es obligatorio.',
            'name.max' => 'Solo se permiten 50 caracteres.',
            'email.required' => 'Debe ingresar un correo electrónico, es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico valido.',
            'email.unique' => 'El correo electrónico ingresado ya existe.',
            'email.max' => 'Solo se permiten 50 caracteres.',
            'password.required' => 'Debe ingresar una clave, es obligatorio.',
            'password.min' => 'Debe ingresar al menos 8 caracteres.',
            'password.max' => 'Solo se permiten 50 caracteres.',
            'password_confirmation.required' => 'Debe ingresar nuevamente la clave.',
            'password_confirmation.min' => 'Debe ingresar al menos 8 caracteres',
            'password_confirmation.max' => 'Solo se permiten 50 caracteres.',
            'password_confirmation.same' => 'Las claves no coinciden.',
            'rol.required' => 'Debe seleccionar un rol, es obligatorio.',
            'sucursal.required' => 'Debe seleccionar una sucursal, es obligatorio.',
            'sucursal.numeric' => 'Favor ingrese id de sucursal.'
        ];
    }

}
