<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'is_liquidation' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return[
            'is_liquidation.required' => 'O campo é obrigatório',
            'is_liquidation.boolean' => 'insira true or false',
        ] ;
       
    }
}
