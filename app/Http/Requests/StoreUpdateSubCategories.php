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
            'image' => ['required','mimes:jpg,bmp,png,ico,svg'],
            // 'color_card'=> ['required'],
            'color_name' => ['required'],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'O campo de nome é obrigatório.',
            'name.min' => 'O campo de nome deve ter pelo menos 2 caracteres.',
            'name.max' => 'O campo de nome não deve exceder 255 caracteres.',

            'image.mimes' => 'A imagem deve ser do tipo jpg, bmp, svg ou png.',
            'image.required' => 'A imagem deve ser obrigatória.',

            'color_card' => 'Você precisa informar a cor do card',
            'color_name' => 'Você precisa informar a cor do nome',
            'category_id' => 'Você precisa informar o ID da categoria',

        ];
    }
}
