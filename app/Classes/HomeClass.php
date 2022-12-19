<?php

namespace App\Classes;
use App\Models\Clinica;
use App\Models\Especialidade;
use App\Models\ClinicaEspecialidade;
use App\Models\Usuario;
use Illuminate\Http\Request;

class HomeClass{

    //Especialidades
    public function getSpecialty()
    {
        $specialty = Especialidade::all();
        return $specialty;
    }

    //pesquisa rapida na pagina principal
    public function searchIndex(Request $request)
    {

        $earchSelect = $request->input("searchSelect");
        $searchInput = $request->input("searchInput");

        //pesquisando clinicas
        if ($earchSelect == 1) {

            $results = Clinica::select('clinicas.*','provincias.nome as nome_provincia')
            ->join('provincias', 'provincias.id_provincia', '=', 'clinicas.id_provincia')
            ->where(function($query) use($searchInput){
                if(isset($searchInput)){
                    $query->where("clinicas.nome", "LIKE", "%{$searchInput}%")
                    ->orwhere("clinicas.localizacao", "LIKE", "%{$searchInput}%")
                    ->orwhere("provincias.nome", "LIKE", "%{$searchInput}%");
                }
            })->groupBy('clinicas.id_clinica')
            ->paginate(2);

            return $results;

        }

        //pesquisando Medicos
        if ($earchSelect == 2) {

            $results = Usuario::select('usuarios.*','provincias.nome as nome_provincia')
            ->join('provincias', 'provincias.id_provincia', '=', 'usuarios.id_provincia')
            ->where('id_tipo_usuario','=', 1)
            ->where(function($query) use($searchInput){
                if(isset($searchInput)){
                    $query->where("usuarios.nome", "LIKE", "%{$searchInput}%")
                    ->orwhere("provincias.nome", "LIKE", "%{$searchInput}%");
                }
            })->groupBy('usuarios.id_usuario')
            ->paginate(12);

            return $results;
        }

        //pesquisando Especialidades
        if ($earchSelect == 3) {

            $results2 = ClinicaEspecialidade::select('clinicas.*', 'especialidades.nome as nome_especialidade',  'provincias.nome as nome_provincia')
            ->join('especialidades', 'especialidades.id_especialidade', '=', 'clinica_especialidade.id_especialidade')
            ->join('clinicas', 'clinicas.id_clinica', '=', 'clinica_especialidade.id_clinica')
            ->join('provincias', 'provincias.id_provincia', '=', 'clinicas.id_provincia')
            ->where(function($query) use($searchInput){
                if(isset($searchInput)){
                    $query->where("especialidades.nome", "=", $searchInput);
                }
             })->groupBy('clinicas.id_clinica')
             ->paginate(2);

             return $results2;
        }





    }
}

?>
