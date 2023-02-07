<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserEditFreeRequest extends FormRequest
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
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'string',
      'surname' => 'string|max:255|nullable',
      'patronymic' => 'string|max:255|nullable',
      'gender' => 'string|max:255',
      'avatar' => '',
      'status' => 'string|max:255',
      'birth_date' => 'string|max:255|nullable',
      'theme' => 'string',
      'locale' => 'string',
      'ban' => 'string',
      'currency' => 'string',
      'logout' => 'string'
    ];
  }
}
