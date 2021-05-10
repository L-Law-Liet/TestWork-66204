<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:191'],
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'price' => ['required', 'integer'],
            'description' => ['required'],
        ];
    }

//    public function messages()
//    {
//        return [
//            'name.required' => 'Заполните название продукта',
//            'name.string' => 'Неверный формат ввода',
//            'name.max' => 'Превышен лимит символов',
//            'price.required' => 'Укажите цену продукта',
//            'description.required' => 'Добавьте описание для продукта',
//        ];
//    }
}
