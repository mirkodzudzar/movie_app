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
          'first_name' => 'required|string|max:255|required|regex: /^([a-zA-Z\' ]+)$/',
          'last_name' => 'required|string|max:255|required|regex: /^([a-zA-Z\' ]+)$/',
          'date_of_birth' => 'required|date_format:Y-m-d|before:today|nullable',
          'state_of_birth' => 'string|max:255',
          'username' => 'required|string|max:255',//unique:users
          'email' => 'required|string|email|max:255',//unique:users
          'password' => 'confirmed',
          'role_id' => 'required|integer',
          'photo_id' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
