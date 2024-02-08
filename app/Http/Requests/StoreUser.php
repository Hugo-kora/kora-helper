<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', "unique:users,email,{$id},id"],
            'nomeInGame' => ['nullable', 'string', 'min:3', 'max:255'],
            'surnameInGame' => ['nullable', 'string', 'min:3', 'max:255'],
            'passaporte' => ['required', 'string', 'min:1', 'max:10'],
            'password' => ['nullable', 'string', 'min:6', 'max:32']
        ];
    
        if ($this->method() == 'PUT') {
            $rules['password'] = ['nullable', 'string', 'min:6', 'max:16'];
        }
    
        if ($this->method() == 'PUT') {
            $rules['passaporte'] = ['nullable', 'string', 'min:1', 'max:10'];
        }
    
        return $rules;
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Você deve inserir um Nome para o usuário',
            'name.min' => 'O nome deve conter no mínimo 3 caracteres',
            'name.max' => 'O nome deve conter no máximo 255 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Você deve enviar um email no formato válido',
            'email.unique' => 'Email já cadastrado',
            'nomeInGame.min' => 'O nome dentro do jogo precisa ter mais de 2 caracteres ',
            'nomeInGame.max' => 'É sério que o nome do personagem é grande desse jeito? Deixa de ser tanso e encurta isso.',
            'passaporte.required' => 'Você precisa informar o passaporte do jogador.',
            'at_least_one_field.required' => 'Você deve preencher pelo menos um dos campos: Nome no Jogo ou Sobrenome no Jogo.',
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
