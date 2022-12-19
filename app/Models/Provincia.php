<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias';
    protected $primaryKey = 'id_provincia';
    public $timestamps = false;

    public function clinica()
    {
        return $this->hasMany('App\Models\Clinica');
    }

    public function usuarios()
    {
        return $this->hasMany('App\Models\Usuario'); //para cada provincia deste modulo existe varios registros dentro do usuario
    }

    public function pais()
    {
        return $this->belongsTo('App\Models\Pais');
    }
}
