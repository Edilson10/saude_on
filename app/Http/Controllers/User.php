<?php

namespace App\Http\Controllers;

use App\Classes\UserClass;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserClass();
    }

    public function showProfile(Request $request)
    {

        $provices = $this->user->getProvince();
        $users = $this->user->getValuesUser();
        return view("user.profile", [
            'users' => $users,
            'provinces' => $provices

        ]);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        //validacao
        $request->validated();

        $this->user->update($request);
        return redirect()->back()->with('message', 'Usuario Atualizado com sucesso');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {

        //validaca
        $request->validated();

        $current_user = session('usuario');

        if (Hash::check($request->old_password, $current_user->senha)) {

            $current_user->update([
                'senha' => bcrypt($request->new_password)
            ]);

            return redirect()->back()->with('message', 'Senha atualizada com suceso');
        } else {
            return redirect()->back()->with('message', 'Erro ao tentar atualizar a senha');
        }
    }

}
