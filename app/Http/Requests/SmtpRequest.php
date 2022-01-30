<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmtpRequest extends FormRequest
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

            "smtp_ip" => ['required'],
            "smtp_port" => ['required'],
            "smtp_auth" => ['required'],
            "smtp_from" => ['required'],
            "smtp_mail" => ['required'],
            "smtp_username" => ['required'],
            "smtp_password" => ['required'],

        ];
    }

}
