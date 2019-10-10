<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieCreateRequest extends FormRequest
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
              'name' => 'required|string|max:255|required|regex: /^([a-zA-Z\' ]+)$/',
              'description' => 'required',
              'time_duration' => '',
              'release_date' => 'date',
              'director_id' => 'required|integer',
        ];
    }
}