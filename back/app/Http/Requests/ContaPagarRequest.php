<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaPagarRequest extends FormRequest
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
        return [
            'descricao' => 'required|max:191',
            'valor' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'O campo de descrição é obrigatório',
            'valor.required' => 'O valor é obrigatório',
        ];
    }
}
