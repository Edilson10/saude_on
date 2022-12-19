<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoEspecialidade extends Model
{
    protected $table = 'medico_especialidade';
    protected $primaryKey = 'id_medico_especialidade';

    public $timestamps = false;

    public function especialidades()
    {
        return $this->belongsTo('App\Models\Especialidade', 'id_especialidade', 'id_especialidade');
    }

    public function medicos()
    {
        return $this->belongsTo('App\Models\Usuario', 'id_usuario', 'id_medico');
    }
}
