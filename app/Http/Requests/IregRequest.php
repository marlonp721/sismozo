<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IregRequest extends FormRequest
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
//      $name_rules = ['required', 'unique:ir21_documents'];

        return [

                'pais' => ['required'],
                'tadig' => ['required'],
                'operador_name' => ['required'],
                'conexion' => ['required'],

        ];
    }
}
