<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePermissionRequest extends FormRequest
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
            'name' => [
                'required',
                'min:3',
                'max:255',
                'string',
                Rule::unique('permissions')->ignore($this->permission)
            ],
            'description' => [
                // 'nullable',
                'required',
                'min:3',
                'max:255',
                'string'
            ]
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'O campo de nome da permissão é obrigatório.',
            'name.min' => 'O campo de nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'O campo de nome não deve exceder 255 caracteres.',
            'name.string' => 'O campo de nome deve ser uma string.',
            'name.unique' => 'Esta permissão já existe.',

            'description.required' => 'O campo de descrição da permissão é obrigatório.',
            'description.min' => 'O campo de descrição deve ter pelo menos 3 caracteres.',
            'description.max' => 'O campo de descrição não deve exceder 255 caracteres.',
            'description.string' => 'O campo de descrição deve ser uma string.',
        ];
    }
}