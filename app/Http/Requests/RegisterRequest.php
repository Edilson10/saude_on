<?php

namespace App\Http\Requests;

use App\Rules\FullName;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => ['required', new FullName],
            'email' => ['required', 'email', 'unique:usuarios'],
            'celular' => ['required', 'min:9', 'max:9', 'unique:usuarios'],
            'provincia' => ['required', 'not_in:0'],
            'senha' => ['required', 'min:6', 'max:20'],
            'senha_confirmation' => ['required', 'same:senha']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome é de preenchimento obrigatorio',
            'email.required' => 'E-mail é de preenchimento obrigatorio',
            'email.email' => 'E-mail tem que ser um email válido',
            'email.unique' => 'Este enderço de e-mail já esta cadastrado',
            'celular.required' => 'Celular é de preenchimento obrigatorio',
            'celular.min' => 'O celular tem que ter :min Caracteres',
            'celular.max' => 'O celular tem que ter :max Caracteres',
            'celular.unique' => 'Numero de celular já esta cadastrado',
            'senha.required' => 'Senha é obrigatoria',
            'provincia.required' => 'provincia é obrigatoria',
            'provincia.not_in' => 'Selecione uma provincia',
            'senha.min' => 'A senha tem que ter no minimo :min Caracteres',
            'senha.max' => 'A senha tem que ter no maximo :max Caracteres',
            'senha_confirmation.same' => 'senhas diferentes',
            'senha_confirmation.required' => 'E nececessario confirmar a senha'
        ];
    }
}
