<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LdapRequest extends FormRequest
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
            'ldap_ip'       => ['required'],
            'ldap_port'     => ['required'],
            'ldap_protocol'     => ['required'],
            'ldap_dn'   => ['required'],

        ];
    }

}
