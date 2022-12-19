<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    protected $table = 'clinicas';
    protected $primaryKey = 'id_clinica';
    public $timestamps = false;

    public function horarios()
    {
        return $this->belongsTo('App\Models\Horario', 'id_horario', 'id_horario');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia', 'id_provincia', 'id_provincia');
    }

    public function especialidades()
    {
        return $this->belongsToMany('App\Models\Especialidade', 'id_especialidade', 'id_especialidade');
    }

    public function medicoClina()
    {
        return $this->hasMany('App\Models\MedicoClinica', 'id_medico_clinica', 'id_medico_clinica');
    }

    public function consultas()
    {
        return $this->hasMany('App\Models\Consulta', 'id_consulta', 'id_consulta');
    }

}
