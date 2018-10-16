<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSetup extends FormRequest
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
            'name' => 'required|max:255'
        ];
    }

    /**
     * Set messages from validation rules
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'custom.name.required' => 'Name is required'
        ];
    }
}
