<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new Usuario();
        $user->nome = 'Dental dream';
        $user->email = 'dental@gmail.com';
        $user->celular = '844546777';
        $user->senha = Hash::make('dream111');
        $user->id_provincia = 1;
        $user->id_tipo_usuario = 3;
        $user->save();
    }
}
