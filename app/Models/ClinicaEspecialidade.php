<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicaEspecialidade extends Model
{
    protected $table = 'clinica_especialidade';
    protected $primaryKey = 'id_clinica_especialidade';

    public $timestamps = false;

    public function especialidades()
    {
        return $this->belongsTo('App\Models\Especialidade', 'id_especialidade', 'id_especialidade');
    }

    public function clinicas()
    {
        return $this->belongsTo('App\Models\Clinica', 'id_clinica', 'id_clinica');
    }
}
