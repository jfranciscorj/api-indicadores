<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndicador extends FormRequest
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
            "nombreIndicador" => "required|max:50",
            "codigoIndicador" => "required|max:50",
            "unidadMedidaIndicador" => "required|max:50",
            "valorIndicador" => "required|numeric",
            "fechaIndicador" => "required|max:50|date",
            "tiempoIndicador" => "nullable|max:50",
            "origenIndicador" => "required|max:50"
        ];
    }
}
