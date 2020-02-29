<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
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
            'b_name'=>'required|unique:brand|max:20',
            'b_url'=>'required'
        ];
    }

    public function messages(){
        return [
            'b_name.required'=>'名称不能为空',
            'b_name.max'=>'名称长度不能超过20位',
            'b_name.unique'=>'名称已存在',
            'b_url.required'=>'网址不能为空',
        ];
    }
}
