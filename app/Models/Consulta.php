<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    public $timestamps = false;
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_usuario', 'id_usuario');
    }

    public function clinicas()
    {
        return $this->belongsTo('App\Models\Clinica', 'id_clinica', 'id_clinica');
    }

    public function medicos()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_usuario', 'id_medico');
    }

    public function especialidades()
    {
        return $this->belongsTo('App\Models\Especialidade', 'id_especialidade', 'id_especialidade');
    }

    public function disponibilidades()
    {
        return $this->belongsTo('App\Models\Disponibilidade', 'id_disponibilidade', 'id_disponibilidade');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\Estado', 'id_estado', 'id_estado');
    }
}
