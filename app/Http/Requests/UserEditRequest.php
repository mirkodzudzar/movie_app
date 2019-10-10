<?php

namespace App\Http\Requests;

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
     * @return array
     */
    public function rules()
    {
        return [
          'first_name' => 'string|max:255|required|regex: /^([a-zA-Z\' ]+)$/',
          'last_name' => 'string|max:255|required|regex: /^([a-zA-Z\' ]+)$/',
          'date_of_birth' => 'date_format:Y-m-d|before:today|nullable',
          'state_of_birth' => 'string|max:255',
          'username' => 'string|max:255',//unique:users
          'email' => 'string|email|max:255',//unique:users
          'password' => 'confirmed',
          'role_id' => 'integer'
        ];
    }
}
