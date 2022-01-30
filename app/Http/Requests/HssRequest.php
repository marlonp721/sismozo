<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HssRequest extends FormRequest
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
            'hss_ip'      => ['required'],
            'hss_port'    => ['required'],
            'hss_user' => ['required'],
            'hss_passwd'  => ['required'],

        ];
    }

}
