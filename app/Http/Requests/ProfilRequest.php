<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilRequest extends FormRequest
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

    public function rules() {
        return [
            'name' => 'required|max:20|min:3',
            'useImg' => 'image|mimes:jpeg,jpg,png',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => __('customizeValidation.The name field is required.'),
            'name.min' => __('customizeValidation.The name may not be greater than 3 characters.'),
            'useImg.image' => __('customizeValidation.The image must be an image.'),
            'useImg.mimes' => __('customizeValidation.The image must be a file of type:jpeg, jpg, png.'),
        ];
    }


}
