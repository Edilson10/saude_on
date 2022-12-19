<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'id_provincia',
        'id_tipo_usuario',
        'id_perfil',
        'id_clinica',
        'id_imagem'
    ];


    public function clinicas()
    {
        return $this->belongsTo('App\Models\Clinica', 'id_clinica', 'id_clinica');
    }

    public function provincias()
    {
        return $this->belongsTo('App\Models\Provincia', 'id_provincia', 'id_provincia'); //quem contem a provincia
    }

    public function tipoUsuario()
    {
        return $this->belongsTo('App\Models\TipoUsuario', 'id_tipo_usuario', 'id_tipo_usuario');
    }

    public function perfil()
    {
        return $this->belongsTo('App\Models\Perfil', 'id_perfil', 'id_perfil');
    }

    public function especialidades()
    {
        return $this->belongsToMany('App\Models\Especialidade', 'id_especialidade', 'id_especialidade');
    }

    public function medicoClina()
    {
        return $this->hasMany('App\Models\MedicoClinica', 'id_medico_clinica', 'id_medico_clinica');
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
