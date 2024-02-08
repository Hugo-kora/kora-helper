<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSubCategories extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Você pode ajustar a lógica de autorização conforme necessário
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
            'category_id' => 'required|exists:categories,id',
            'image' => ['mimes:jpg,bmp,png,ico,svg'],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'O campo de nome é obrigatório.',
            'name.min' => 'O campo de nome deve ter pelo menos 2 caracteres.',
            'name.max' => 'O campo de nome não deve exceder 255 caracteres.',

            'image.mimes' => 'A imagem deve ser do tipo jpg, bmp, svg ou png.',

            'category_id' => 'Você precisa informar o ID da categoria',

            'anchor_url.required' => 'A Url Externa é obrigatória.',
        ];
    }
}
