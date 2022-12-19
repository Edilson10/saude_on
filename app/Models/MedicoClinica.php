<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoClinica extends Model
{
    protected $table = 'medico_clinica';
    protected $primaryKey = 'id_medico_clinica';
    public $timestamps = false;

    public function clinicas()
    {
        return $this->belongsToMany('App\Models\Clinica', 'id_clinica', 'id_clinica');
    }

    public function medicos()
    {
        return $this->belongsToMany('App\Models\Usuario', 'id_usuario', 'id_medico');
    }

    public function estado()
    {
        return $this->belongsToMany('App\Models\Estado', 'id_estado', 'id_estado');
    }

    public function disponibilidades()
    {
        return $this->hasMany('App\Models\MedicoClinica', 'id_medico_clinica', 'id_medico_clinica');
    }
}
