<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpsRequest extends FormRequest
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
            'sps_ip'      => ['required'],
            'sps_port'    => ['required'],
            'sps_user'    => ['required'],
            'sps_passwd'  => ['required'],

        ];
    }

}
