<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';
    protected $primaryKey = 'id_estado';
    public $timestamps = false;

    public function medicoClina()
    {
        return $this->hasMany('App\Models\MedicoClinica', 'id_medico_clinica', 'id_medico_clinica');
    }

    public function medicoClinaEspecialidades()
    {
        return $this->hasMany('App\Models\MedicoClinicaEspecialidade', 'id_medico_clinica_especialidade', 'id_medico_clinica_especialidade');
    }
}
