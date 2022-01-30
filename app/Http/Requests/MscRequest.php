<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MscRequest extends FormRequest
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
            'msc_ip'      => ['required'],
            'msc_port'    => ['required'],
            'msc_user' => ['required'],
            'msc_passwd'  => ['required'],

        ];
    }

}
