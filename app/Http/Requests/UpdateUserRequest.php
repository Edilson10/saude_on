<?php

namespace App\Http\Requests;

use App\Rules\FullName;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Usuario;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        $user = session('usuario');
        return [
            'nome' => ['required', new FullName],
            'provincia' => ['required', 'not_in:0'],
            'email' => ['required', 'email', Rule::unique('usuarios')->ignore($user)],
            'celular' => ['required', 'min:9', 'max:9', Rule::unique('usuarios')->ignore($user)]
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
            'provincia.required' => 'provincia é obrigatoria',
            'provincia.not_in' => 'Selecione uma provincia'
        ];
    }
}
