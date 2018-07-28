<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|min:5|max:200',
        ];
    }
    public function messages()
    {
        return [
            'name.min' => 'Tên thể loại tối thiểu phải 5 kí tự và tối đa 200 kí tự',
            'name.max' => 'Tên thể loại thiểu phải 5 kí tự và tối đa 200 kí tự',
        ];
    }
}
