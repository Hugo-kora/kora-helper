<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'O campo de nome deve ser uma string.',
            'name.max' => 'O campo de nome não deve exceder 255 caracteres.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.max' => 'O endereço de e-mail não deve exceder 255 caracteres.',
            'email.unique' => 'Este endereço de e-mail já está sendo utilizado por outro usuário.',
        ];
    }
}
