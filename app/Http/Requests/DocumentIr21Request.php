<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentIr21Request extends FormRequest
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
//        $id = $this->segment(4);
//
//        $unique_company = 'unique:parameters,display_name,' . $id . ',id,deleted_at,NULL,list,areas';
//dd($this->get('mcc'),$this->get('mnc'),$this->get('cc'),$this->get('nc'),'tmr');
//        dd($this->get('mcc'));
        return [
          'mcc'=>['required'],
          'mnc'=>['required'],
          'name'=>['required'],
//          'mcc.*' => ['required_with:cc.*,nc.*','exists:roaming_agreement,mcc'],
          'mcc.*' => ['required_with:cc.*,nc.*','exists_value:mcc'],
          'mnc.*'  => ['required_with:cc.*,nc.*','exists_value:mnc'],
//          'mnc.*'  => ['required_with:cc.*,nc.*','exists:roaming_agreement,mnc'],
        ];
    }

  public function messages()
  {

    $messages = [];
    $mcc = !empty($this->get('mcc')) ? $this->get('mcc'):null;
    $mnc = !empty($this->get('mnc')) ? $this->get('mnc'):null;

    if(!is_null($mcc)){
      foreach ($this->get('mcc') as $key => $val) {

        $i = $key + 1;

        $messages["mcc.$key.required"] = "El mcc $i es obligatorio";
        $messages["mcc.$key.required_with"] = "El mcc $i es obligatorio";
        $messages["mcc.$key.exists_value"] = "El mcc $i no existe";
        $messages["mcc.$key.exists"] = "El mcc $i no existe";
      }
    }

    if(!is_null($mnc)){
      foreach ($this->get('mnc') as $key => $val) {

        $i = $key + 1;
        $messages["mnc.$key.required"] = "El mnc $i es obligatorio";
        $messages["mnc.$key.required_with"] = "El mnc $i es obligatorio";
        $messages["mnc.$key.exists_value"] = "El mnc $i no existe";
        $messages["mnc.$key.exists"] = "El mnc $i no existe";
      }
    }

    return $messages;

  }
}
