<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
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
            'image' => 'mimes:jpeg, jpg, png, gif, bmp|max:2048',
            'note' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'image' => 'Добавьте изображение',
            'image.max' => 'Размер изображения не должен превышать 2мб',
            'note.required' => 'Поле ОТЗЫВ обязательно для заполнения',
            'image.mimes' => 'Для загрузки доступны jpeg,jpg,png,gif,bmp файлы'
        ];
    }
}
