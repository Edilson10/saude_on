<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Usuario;
use App\Classes\UserClass;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;

class Login extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserClass();
    }

    public function index()
    {
        //$userSession = session('usuario')['inadmin'];
        //dd($userSession);

    }



    public function showLogin()
    {
        //verificar se ja existe sessao
        if ($this->user->checkSession()) {
            return redirect()->route('home');
        }

        $erro = session('erro');
        $data = [];
        if (!empty($erro)) {
            $data = [
                'erro' => $erro
            ];
        }
        return view('login.login', $data);
    }

    public function loginSubmit(LoginRequest $request)
    {
        //verificar se houve submissao de formulario
        if (!$request->isMethod('post')) {
            return redirect()->route('home');
        }

        //verificar se ja existe a sessao
        if ($this->user->checkSession()) {
            return redirect()->route('home');
        }

        //validacao
        $request->validated();

        //verificar dados de login
        $user = trim($request->input('usuario'));
        $password = trim($request->input('senha'));

        $usuario = Usuario::where('email', $user)->orwhere('celular', $user)->first();

        //verificar se o usaurio exite
        if (!$usuario || $usuario->id_tipo_usuario != 2) {
            session()->flash('erro', 'Usuario ou senha inéxistente'); //definindo uma variavel temporaria na sessao
            return redirect()->route('login');
        }

        //verificar se a senha esta correta
        if (!Hash::check($password,   $usuario->senha)) {
            session()->flash('erro', 'Usuario ou senha inéxistente'); //definindo uma variavel temporaria na sessao
            return redirect()->route('login');
        }

        //login é valido
        session()->put('usuario', $usuario); //colocando utilizador na sessao
        return redirect()->route('home');
    }

    public function logout()
    {
        $this->user->logout();
        return redirect()->route('home');
    }

    public function sign()
    {
        $provinces =  $this->user->getProvince();
        return view('login.sign', ['provinces' => $provinces]);
    }

    public function register(RegisterRequest $request)
    {
        //validacao
        $request->validated();

        $this->user->save($request);
        return redirect()->route('login')->with('message', 'Usuario Registrado com sucesso');
    }
}
