<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisponibilidadeEspecialidade extends Model
{
    protected $table = 'disponibilidade_especialidade';
    protected $primaryKey = 'id_medico_clinica';
    public $timestamps = false;

    public function disponibilidades()
    {
        return $this->belongsToMany('App\Models\Disponibilidade', 'id_disponibilidade', 'id_disponibilidade');
    }

    public function medicoClinicaEspecialidade()
    {
        return $this->belongsToMany('App\Models\MedicoClinicaEspecialidade', 'id_medico_clinica_especialidade', 'id_medico_clinica_especialidade');
    }
}
