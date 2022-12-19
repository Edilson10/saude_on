<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Classes\UserClass;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class Admin extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserClass();
    }



    public function admin()
    {
        return view('admin.layout_admin');
    }

    public function showLogin()
    {
        //verificar se ja existe sessao
        if ($this->user->checkSessionAdmin()) {
            return redirect()->route('admin');
        }

        $erro = session('erro');
        $data = [];
        if (!empty($erro)) {
            $data = [
                'erro' => $erro
            ];
        }
        return view('admin.login', $data);
    }

    public function loginSubmit(LoginRequest $request)
    {

        //verificar se houve submissao de formulario
        if (!$request->isMethod('post')) {
            return redirect()->route('admin_login');
        }

        //verificar se ja existe a sessao
        if ($this->user->checkSessionAdmin()) {
            return redirect()->route('admin');
        }

        //validacao
        $request->validated();

        //verificar dados de login
        $user = trim($request->input('usuario'));
        $password = trim($request->input('senha'));

        $usuario = Usuario::where('email', $user)->orwhere('celular', $user)->first();


        //verificar se o usaurio exite
        if (!$usuario || $usuario->id_clinica == Null) {
            session()->flash('erro', 'Usuario ou senha inéxistente'); //definindo uma variavel temporaria na sessao
            return redirect()->route('admin_login');
        }

        //verificar se a senha esta correta
        if (!Hash::check($password,   $usuario->senha)) {
            session()->flash('erro', 'Usuario ou senha inéxistente'); //definindo uma variavel temporaria na sessao
            return redirect()->route('admin_login');
        }

        //login é valido
        session()->put('clinica', $usuario); //colocando utilizador na sessao
        return redirect()->route('admin');
    }

    public function logout()
    {
        $this->user->logoutAdmin();
        return redirect()->route('admin_login');
    }
}
