<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentIr21RequestCreate extends FormRequest
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
//        dd($this->get('ir21'),$this->request->get('ir21.items'));
        $items = $this->get('ir21');
//        dd(collect($items['items'])->flatten(),$items['items']);

        $rules['ir21.name'] =["required"];

        if(isset($items['items'])){
          foreach($items['items'] as $key => $val) {
            $rules['ir21.items.'.$key.'.mcc'] = ["required_with:ir21.items.$key.cc214,ir21.items.$key.nc","exists_value:mcc"];
            $rules['ir21.items.'.$key.'.mnc'] = ["required_with:ir21.items.$key.cc214,ir21.items.$key.nc","exists_value:mnc"];
          }
        }else{
          $rules['items'] =['required'];
        }

//        dd($rules);
      return $rules;
//      $rules = [
////          'mcc'=>['required'],
////          'mnc'=>['required'],
////          'mcc.*' => ['required_with:cc.*,nc.*','exists:roaming_agreement,mcc'],
//          'ir21.items.*.mcc' => ['required'],
////          'mnc.*'  => ['required_with:cc.*,nc.*','exists_value:mnc'],
////          'mnc.*'  => ['required_with:cc.*,nc.*','exists:roaming_agreement,mnc'],
//        ];
//      dd($rules);
    }

  public function messages()
  {

    $messages = [];
    $messages["ir21.name.required"] = "El campo Nombre de Archivo es obligatorio.";
    $messages["items.required"] =  "El campo mnc y mcc son obligatorios";

    $items = $this->get('ir21');
    if(isset($items['items'])){
      foreach ($items['items'] as $key => $val) {

        $i = $key + 1;

        $messages["ir21.items.$key.mcc.required_with"] = "El mcc $i es obligatorio";
        $messages["ir21.items.$key.mnc.required_with"] = "El mnc $i es obligatorio";
        $messages["ir21.items.$key.mnc.exists_value"] = "El mnc $i no existe";
        $messages["ir21.items.$key.mcc.exists_value"] = "El mcc $i no existe";

      }
    }

//    $mcc = !empty($this->get('mcc')) ? $this->get('mcc'):null;
//    $mnc = !empty($this->get('mnc')) ? $this->get('mnc'):null;
//
//    if(!is_null($mcc)){
//      foreach ($this->get('mcc') as $key => $val) {
//
//        $i = $key + 1;
//
//        $messages["mcc.$key.required"] = "El mcc $i es obligatorio";
//        $messages["mcc.$key.required_with"] = "El mcc $i es obligatorio";
//        $messages["mcc.$key.exists_value"] = "El mcc $i no existe";
//        $messages["mcc.$key.exists"] = "El mcc $i no existe";
//      }
//    }
//
//    if(!is_null($mnc)){
//      foreach ($this->get('mnc') as $key => $val) {
//
//        $i = $key + 1;
//        $messages["mnc.$key.required"] = "El mnc $i es obligatorio";
//        $messages["mnc.$key.required_with"] = "El mnc $i es obligatorio";
//        $messages["mnc.$key.exists_value"] = "El mnc $i no existe";
//        $messages["mnc.$key.exists"] = "El mnc $i no existe";
//      }
//    }
//
    return $messages;

  }
}
