<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoClinicaEspecialidade extends Model
{
    protected $table = 'medico_clinica_especialidade';
    protected $primaryKey = 'id_medico_clinica_especialidade';
    protected $fillable = [
        'id_medico_clinica',
        'id_especialidade',
        'id_ estado',
    ];

    public $timestamps = false;

    public function medicoclinas()
    {
        return $this->belongsToMany('App\Models\MedicoClinica', 'id_medico_clinica', 'id_medico_clinica');
    }

    public function especialidades()
    {
        return $this->belongsToMany('App\Models\Especialidade', 'id_especialidade', 'id_especialidade');
    }

    public function estado()
    {
        return $this->belongsToMany('App\Models\Estado', 'id_estado', 'id_estado');
    }
}
