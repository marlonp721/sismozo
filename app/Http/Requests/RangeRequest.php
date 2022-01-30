<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RangeRequest extends FormRequest
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

      'apn_id_element'  => ['required','max:5'],
      'ip_start'        => ['required','max:15'],
      'ip_end'          => ['required','max:15'],
      'pcrf'            => ['required','max:1'],

    ];

  }
}
