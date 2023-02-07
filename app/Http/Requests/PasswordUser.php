<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUser extends FormRequest
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
            'password' => 'required|min:8|max:255',
            'password_confirmation' => 'required|min:8|max:255|same:password'
        ];
    }

    public function attributes(){
        return[
            'password' => 'Clave',
            'password_confirmation' => 'Confirme clave',
        ];
    }

    public function messages(){
        return [
            'password.required' => 'Debe ingresar una clave, es obligatorio',
            'password.min' => 'Debe ingresar al menos 8 caracteres',
            'password_confirmation.required' => 'Debe ingresar nuevamente la clave',
            'password_confirmation.min' => 'Debe ingresar al menos 8 caracteres',
            'password_confirmation.same' => 'Las claves no coinciden',
        ];
    }
}
