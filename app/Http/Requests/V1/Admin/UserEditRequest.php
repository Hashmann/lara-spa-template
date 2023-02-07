<?php

namespace App\Http\Requests\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'role' => '',
//            'file' => '',
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|email|max:255|',
            'surname' => 'string|max:255|nullable',
            'patronymic' => 'string|max:255|nullable',
//            'gender' => 'string|max:255',
            'gender' => '',
            'avatar' => '',
            'status' => 'string|max:255',
            'birth_date' => 'string|max:255|nullable',
        ];
    }
}
