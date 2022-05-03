<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
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
            'description' => ['required', 'max:5000', 'min:2'],
            'price' => ['numeric', 'min:0'],
            'price_type_id' => ['required', 'numeric'],
            'service_category_id' => ['required', 'numeric'],
            'service_image' => ['required', 'image', 'max:2048'],
            'area' => ['required'],
            'area.*' => ['numeric', 'min:1']
        ];
    }
}
