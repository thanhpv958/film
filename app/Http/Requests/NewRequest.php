<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRequest extends FormRequest
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
            'title' => 'required|min:5|max:200',
            'body' => 'required|min:5',
        ];
    }
    public function messages()
    {
        return [
            'title.min' => 'Tiêu đề tối thiểu phải 5 kí tự và tối đa 200 kí tự',
            'title.max' => 'Tiêu đề tối thiểu phải 5 kí tự và tối đa 200 kí tự',
            'body.min' => 'Nội dung tối thiểu phải 1 kí tự và tối đa 5 kí tự'
        ];
    }
}
