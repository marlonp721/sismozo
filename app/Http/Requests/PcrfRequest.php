<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PcrfRequest extends FormRequest
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
            'pcrf_ip'       => ['required'],
            'pcrf_port'     => ['required'],
            'pcrf_user'     => ['required'],
            'pcrf_passwd'   => ['required'],

        ];
    }

}
