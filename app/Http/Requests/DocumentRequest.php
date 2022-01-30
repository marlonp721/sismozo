<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DocumentRequest extends FormRequest
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
    $data = $_REQUEST['apn_id'];

    return [
      'msisdn'  => ['required','validate_imsi_msisdn:'.$data,'validate_regex_lines:/^51/,2','digits_lines:11'],
      'imsi'    => ['required','validate_imsi_msisdn:'.$data,'validate_regex_lines:/^71617$/,5','digits_lines:15'],

    ];
  }
}
