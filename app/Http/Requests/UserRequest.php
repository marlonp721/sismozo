<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Security\Entities\User;
use Illuminate\Http\JsonResponse;

class UserRequest extends FormRequest
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

        //$unique_company = 'unique:parameters,display_name,' . $id . ',id,deleted_at,NULL,list,companies';
        //$password_rules = $id ? 'min:8|max:15' : 'required|min:8|max:15';
        $username = 'required|min:4|max:45|unique:users,username,null,null,deleted_at,NULL';

        if($id){

          $username = 'required|min:4|max:45|unique:users,username,' . $id . ',id,deleted_at,NULL';

        }
//dd($username);
        $email = 'required|email|max:80|unique:users,email,null,null,deleted_at,NULL';

        if($id){

          $email = 'required|email|max:80|unique:users,email,' . $id . ',id,deleted_at,NULL';

        }


      return [

                'username'      => $username,
                'email'         => $email,
                'status'        => ['required'],
                'roles.*'       => 'exists:roles,id,deleted_at,NULL|exclude_superuser',
        ];
    }

    public function all( $keys = null)
    {
        $input = parent::all();

        $input['roles'] = isset($input['roles']) ? $input['roles'] : [];

        return $input;
    }

}
