<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        //dd('unique',$_REQUEST,$id);
        //$unique_roles = 'unique:roles,display_name,'. $id . ',id,deleted_at,NULL';
        $unique_roles = 'unique:roles,display_name,null,null,deleted_at,NULL';

        if($id){
          $unique_roles= 'unique:roles,display_name,'.$id.',id,deleted_at,NULL';
        }

        //dd($unique_roles);
        return [
                'display_name'    => ['required', 'max:30', $unique_roles, 'regex:/^[a-zA-Z ñÑÁÉÍÓÚáéíóúü]+$/'],
                'permissions'     => 'required',
                'permissions.*'   => 'exists:permissions,id',
        ];
    }

    public function all($keys = null)
    {

        $input = parent::all();

        $input['display_name'] = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $input['display_name'])));
        $input['name'] = '';

        $input['permissions']  = $input['permissions'] ? explode(',', $input['permissions'] ) : [];

        return $input;
    }
}
