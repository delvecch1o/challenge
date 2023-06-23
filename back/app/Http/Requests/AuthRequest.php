<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Cpf;

class AuthRequest extends FormRequest
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
            'name' => 'required|max:191',
            'cpf' => [ 'required', new Cpf , 'unique:users,cpf' ],
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
