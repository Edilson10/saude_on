<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipo_usuario';
    protected $primaryKey = 'id_tipo_usuario';
    public $timestamps = false;

    public function usuarios()
    {
        return $this->hasMany('App\Models\Usuario');
    }
}
