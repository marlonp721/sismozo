<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RacsRequest extends FormRequest
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
        $id = $this->segment(4);

        $unique_company = 'unique:parameters,display_name,' . $id . ',id,deleted_at,NULL,list,racs';


        return [
                'display_name' => ['required', $unique_company, 'max:50', 'regex:/^[a-zA-Z0-9 ñÑÁÉÍÓÚáéíóúü]+$/'],
                'description'  => ['max:255', 'regex:/^[a-zA-Z0-9 ñÑÁÉÍÓÚáéíóúü]+$/'],
        ];
    }
}
