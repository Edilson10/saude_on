<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'usuario' => ['required'],
            'senha' => ['required', 'min:6', 'max:20']
        ];
    }

    public function messages()
    {
        return [
            'usuario.required' => 'usuario é de preenchimento obrigatorio',
            'senha.required' => 'Senha é obrigatoria',
            'senha.min' => 'A senha tem que ter no minimo :min Caracteres',
            'senha.max' => 'A senha tem que ter no maximo :max Caracteres'
        ];
    }
}
