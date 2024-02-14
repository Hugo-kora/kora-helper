<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePassword extends FormRequest
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
        $id = $this->segment(3);

        return [
            'password' => ['required','string', 'min:6', 'max:32']
        ];

        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'string', 'min:6', 'max:16'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'password.required' => 'A senha é obrigatório',
            'password.min' => 'A senha deve ser no mínino 6 caracteres',
            'password.max' => 'A senha deve ser no máximo 32 caracteres'
        ];
    }


    protected function getConditionalRules($field)
    {
        $conditionalRules = ['nullable', 'string', 'min:3', 'max:255'];

        if ($this->input($field) || $this->input('surnameInGame')) {
            $conditionalRules[] = 'required';
        }

        return $conditionalRules;
    }
}
