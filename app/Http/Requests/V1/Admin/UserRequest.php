<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'name' => 'string|max:255',
          'surname' => 'string|max:255',
          'patronymic' => 'string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|between:8,50|confirmed',
          'role' => '',
//          'file' => '',
//          'gender' => 'string|max:255',
          'gender' => '',
          'birth_date' => 'number|max:25',
          'avatar' => 'string|max:255',
          'status' => 'string|max:255',
        ];
    }
}
