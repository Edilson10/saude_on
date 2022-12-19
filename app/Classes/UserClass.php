<?php

namespace App\Classes;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\Provincia;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UserClass
{
    //verificar se a sessao tem um usuario
    public function checkSession()
    {
        return session()->has('usuario');
    }

    //verificar se a sessao tem um usuario
    public function checkSessionAdmin()
    {
        return session()->has('clinica');
    }


    //terminando a sessao usuario
    public function logout()
    {
        return session()->forget('usuario');
    }

    //terminando a sessao admin
    public function logoutAdmin()
    {
        return session()->forget('clinica');
    }

    //retornando provincias
    public function getProvince()
    {
        $results = Provincia::all();
        return $results;
    }

    //inserir usuarios
    public function save(RegisterRequest $request)
    {
        $user = new Usuario();
        $user->nome = $request->input('nome');
        $user->email = trim($request->input('email'));
        $user->celular = trim($request->input('celular'));
        $user->id_provincia = $request->input('provincia');
        $user->id_tipo_usuario = 2;
        $user->senha = Hash::make($request->input('senha'));
        $user->save();
    }

    public function getValuesUser()
    {
        $userSession = session('usuario')['id_usuario'];
        $results = Usuario::select('usuarios.*', 'pr.nome as nome_pr')
            ->join('provincias as pr', 'pr.id_provincia', '=', 'usuarios.id_provincia')
            ->where('id_usuario',  $userSession)
            ->get();
        //dd($results);
        return $results;
    }

    public function update(Request $request)
    {
        $id_user = $request->input('id_usuario');
        $nome = $request->input('nome');
        $email = trim($request->input('email'));
        $celular = trim($request->input('celular'));
        $id_provincia = $request->input('provincia');

        $user = Usuario::find($id_user);
        $user->nome = $nome;
        $user->email = $email;
        $user->celular = $celular;
        $user->id_provincia = $id_provincia;
        $user->save();
    }
}
