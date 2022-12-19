<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'pais';
    protected $primaryKey = 'id_pais';
    public $timestamps = false;

    public function provincias()
    {
        return $this->hasMany('App\Models\Provincia');
    }
}
