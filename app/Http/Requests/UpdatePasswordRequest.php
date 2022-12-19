<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{

    public function rules()
    {
        return [
            'old_password' => ['required', 'min:6', 'max:20'],
            'new_password' => ['required', 'min:6', 'max:20'],
            'confirm_password' => ['required', 'same:new_password'],
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Senha actual é obrigatoria',
            'old_password.min' => 'A senha tem que ter no minimo :min Caracteres',
            'old_password.max' => 'A senha tem que ter no maximo :max Caracteres',
            'new_password.required' => 'Nova senha é obrigatoria',
            'new_password.min' => 'A senha tem que ter no minimo :min Caracteres',
            'new_password.max' => 'A senha tem que ter no maximo :max Caracteres',
            'confirm_password.required' => 'E nececessario confirmar a sua nova senha',
            'confirm_password.same' => 'Senhas diferentes'
        ];
    }
}
