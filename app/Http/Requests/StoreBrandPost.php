<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreBrandPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()//权限
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //表单验证
    public function rules()
    {
        return [
            'brand_name' => [ 
                'required', 
                 Rule::unique('brand')->ignore(request()->id,'brand_id'),
            ], 
            'brand_url' => 'required', 
        ];
    }
    //错误消息
    public function messages(){ 
        return [ 
            'brand_name.required'=>'品牌名称不能为空',
            'brand_name.unique'=>'品牌名称已有',
            'brand_url.required'=>'品牌网址不能为空'
        ]; 
    }
}
