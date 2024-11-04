<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string|max:65000',
            'count' => 'required|numeric|min:1|max:100',
            'price' => 'required|numeric',
            'image' => 'required|file|mimes:jpg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ];
    }
    public function messages():array
    {
        return [
            'required' => 'Это поле обязательно для заполнения.',
            'image.required' => 'Изображение обязательно.',
            'image.mimes' => 'Изображение должно быть формата .jpg, .png или .gif.',
            'image.max' => 'Изображение не должно превышать 2 Мб.',
            'description.max' => 'Описание не должно превышать 65 000 символов.',
            'category_id.exists' => 'Выбранная категория не существует.',
            'price.numeric' => 'Цена должна быть целым числом',
            'count.numeric' => 'Количество должно быть целым числом',
            'count.min' => 'Количество не должно быть меньше 1',
            'count.max' => 'Количество не должно быть больше 100',
        ];
    }
}
