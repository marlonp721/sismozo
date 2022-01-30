<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsnRequest extends FormRequest
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
            'usn_ip'      => ['required'],
            'usn_port'    => ['required'],
            'usn_user'      => ['required'],
            'usn_passwd'  => ['required'],

        ];
    }

}
