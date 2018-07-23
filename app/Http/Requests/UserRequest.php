<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'min:1|max:191|unique:users,email',
            'password' => 'min:6|max:16',
            'passwordAgain' => 'same:password',
            'image' => 'mimes:jpg,jpeg,png,gif,bmp',
        ];
    }
}
