<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $table = 'Especialidades';
    protected $primaryKey = 'id_especialidade';
    public $timestamps = false;

    public function clinicas()
    {
        return $this->belongsToMany('App\Models\Clinica', 'id_clinica', 'id_clinica');
    }

    public function medicos()
    {
        return $this->belongsToMany('App\Models\Usuario', 'id_usuario', 'id_medico');
    }

    public function medicoClinaEspecialidades()
    {
        return $this->hasMany('App\Models\MedicoClinicaEspecialidade', 'id_medico_clinica_especialidade', 'id_medico_clinica_especialidade');
    }

    public function medicoEspecialidades()
    {
        return $this->hasMany('App\Models\MedicoEspecialidade', 'id_medico_especialidade', 'id_medico_especialidade');
    }

    public function consultas()
    {
        return $this->hasMany('App\Models\Consulta', 'id_consulta', 'id_consulta');
    }
}
