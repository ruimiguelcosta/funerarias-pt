<?php

namespace App\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'funeral_home_id' => ['required', 'integer', 'exists:funeral_homes,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'author_name' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'funeral_home_id.required' => 'A funerária é obrigatória.',
            'funeral_home_id.exists' => 'A funerária selecionada não existe.',
            'rating.required' => 'A avaliação é obrigatória.',
            'rating.min' => 'A avaliação deve ser pelo menos 1 estrela.',
            'rating.max' => 'A avaliação deve ser no máximo 5 estrelas.',
            'author_name.required' => 'O nome é obrigatório.',
            'author_name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'comment.required' => 'O comentário é obrigatório.',
            'comment.max' => 'O comentário não pode ter mais de 1000 caracteres.',
        ];
    }
}
