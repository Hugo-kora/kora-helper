<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProfileRequest extends FormRequest
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
    public function rules()
    {
        $id = $this->segment(3);

        return [
            'name' => "required|min:3|max:255|unique:profiles,name,{$id},id",
            'description' => 'nullable|min:3|max:255',
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'Você deve inserir um Nome para o perfil',
            'name.min' => 'O nome deve conter no mínimo 3 caracteres',
            'name.max' => 'O nome deve conter no máximo 255 caracteres',
        ];
    }

}