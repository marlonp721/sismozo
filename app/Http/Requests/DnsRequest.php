<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DnsRequest extends FormRequest
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
            'dns_ip'      => ['required'],
            'dns_port'    => ['required'],
            'dns_user' => ['required'],
            'dns_passwd'  => ['required'],

        ];
    }

}
