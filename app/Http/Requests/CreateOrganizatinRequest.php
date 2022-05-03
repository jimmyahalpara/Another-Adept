<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrganizatinRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'min:3'],
            'description' => ['required', 'max:1020', 'min:2'],
            'identification' => ['required', 'mimes:pdf,jpg,jpeg,png,bmp,gif,svg', 'max:2048'],
        ];
    }
}
