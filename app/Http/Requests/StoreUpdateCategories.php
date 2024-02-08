<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategories extends FormRequest
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
        $id = $this->segment(3);
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'image' => ['mimes:jpg,bmp,png,ico,svg'],
            'anchor_url' => ['required'],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'O campo de nome é obrigatório.',
            'name.min' => 'O campo de nome deve ter pelo menos 2 caracteres.',
            'name.max' => 'O campo de nome não deve exceder 255 caracteres.',

            'image.mimes' => 'A imagem deve ser do tipo jpg, bmp, svg ou png.',

            'anchor_url.required' => 'A Url Externa é obrigatória.',
        ];
    }
}
