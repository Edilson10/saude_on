<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidade extends Model
{
    protected $table = 'disponibilidades';
    protected $primaryKey = 'id_disponibilidade';
    public $timestamps = false;

    public function medicoClinicas()
    {
        return $this->belongsTo('App\Models\MedicoClinica', 'id_medico_clinica', 'id_medico_clinica');
    }

    public function consultas()
    {
        return $this->hasMany('App\Models\Consulta', 'id_consulta', 'id_consulta');
    }
}
