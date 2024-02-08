<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnviarConviteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
        'email' => 'required|email|unique:users,email',
        'profiles_ids' => 'required|array|min:1',
        'profiles_ids.*' => 'exists:profiles,id',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'Este endereço de e-mail já está cadastrado.',
            'profiles_ids.required' => 'É necessário informar pelo menos um perfil para o usuário.',
            'profiles_ids.array' => 'O campo de perfis deve ser um array.',
            'profiles_ids.min' => 'É necessário informar pelo menos um perfil para o usuário.',
            'profiles_ids.*.exists' => 'O perfil selecionado não é válido.',
        ];
    }
}
