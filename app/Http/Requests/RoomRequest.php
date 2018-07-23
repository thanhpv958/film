<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'name' => 'required|min:5|max:191',
            'num_row' => 'required|min:1|max:3',
            'num_seat' => 'required|min:1|max:3',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên phòng',
            'name.min' => 'Tên phòng tối thiểu phải 5 kí tự và tối đa 191 kí tự',
            'name.max' => 'Tên phòng tối thiểu phải 5 kí tự và tối đa 191 kí tự',
            'num_row.required' => 'Bạn chưa nhập số hàng',
            'num_seat.required' => 'Bạn chưa nhập số ghế',
            'num_row.min' => 'Tên phòng tối thiểu phải 1 kí tự và tối đa 3 kí tự',
            'num_seat.min' => 'Tên phòng tối thiểu phải 1 kí tự và tối đa 3 kí tự',
        ];
    }
}
