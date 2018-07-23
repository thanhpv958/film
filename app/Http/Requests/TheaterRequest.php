<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TheaterRequest extends FormRequest
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
            'name' => 'min:5|max:191',
            'phone' => 'min:5|max:13',
            'address' => 'min:10|max:191',
            'image_theater.*' => 'mimes:jpg,jpeg,png,gif,bmp',
        ];
    }
}
