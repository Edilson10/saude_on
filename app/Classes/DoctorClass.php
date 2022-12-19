<?php

namespace App\Classes;

use App\Models\Disponibilidade;
use App\Models\DisponibilidadeEspecialidade;
use App\Models\MedicoEspecialidade;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DoctorClass
{
    //listar medicos
    public function listAll()
    {
        $results = Usuario::with('provincias')->where('id_tipo_usuario','=', 1)->paginate(12);
        return $results;
    }

    //=======================================================================================
    //listar detalhes dos Medicos
    public function listDetail($id_doctor)
    {
        $results = Usuario::with('provincias')->where('id_tipo_usuario','=', 1)->find($id_doctor);
        return $results;
    }

    //=======================================================================================
    //Especialidades dos Medicos
    public function DoctorSpecialty($id_doctor)
    {
        $results = MedicoEspecialidade::with('medicos', 'especialidades')->where('id_medico', $id_doctor)->get();
        return $results;
    }

    //=======================================================================================
    //listar disponibilidades dos Medicos
    public function listDisponibilidade($id_doctor)
    {
        $dataAtual = date('Y-m-d');
        $results = Disponibilidade::select('disponibilidades.*','clinicas.nome', 'clinicas.id_clinica')
        ->join('medico_clinica', 'medico_clinica.id_medico_clinica', '=', 'disponibilidades.id_medico_clinica')
        ->join('clinicas', 'clinicas.id_clinica', '=', 'medico_clinica.id_clinica')
        ->where([
            ['medico_clinica.id_medico', '=', $id_doctor],
            ['data_disponivel', '=', $dataAtual]
        ])
        ->paginate(4);

       return $results;
    }

    //=======================================================================================
    //Pesquisa dos Medicos com  ajax
    public function searchDoctor(Request $request)
    {
        $searchDoctor = $request->input('searchDoctor');
        $speciality = $request->input('speciality');

        $results = MedicoEspecialidade::select('usuarios.*','provincias.nome as nome_provincia')
        ->join('usuarios', 'usuarios.id_usuario', '=', 'medico_especialidade.id_medico')
        ->join('provincias', 'provincias.id_provincia', '=', 'usuarios.id_provincia')
        ->where('id_tipo_usuario','=', 1)
        ->where(function($query) use($searchDoctor){
            if(isset($searchDoctor)){
                $query->where("usuarios.nome", "LIKE", "%{$searchDoctor}%")
                ->orwhere("provincias.nome", "LIKE", "%{$searchDoctor}%");
            }
        })
        ->where(function($query) use($speciality){
           if(isset($speciality)){
                 $query->where("medico_especialidade.id_especialidade", "=", $speciality);
           }
        })->groupBy('usuarios.id_usuario')
        ->paginate(12);
        return $results;
    }

    //pesquisando clinicas nos medicos com ajax
    public function searchClinicDoctorAjax(Request $request)
    {
        $searchClinic = $request->searchClinic;
        $searchSpeciality = $request->searchSpeciality;
        $id_doctor = $request-> id_doctor;
        $searchData = $request->searchData;

        $results = DisponibilidadeEspecialidade::select('disponibilidades.*', 'clinicas.nome', 'clinicas.id_clinica','medico_clinica.id_medico', 'medico_clinica_especialidade.id_especialidade')
        ->join('disponibilidades', 'disponibilidades.id_disponibilidade', '=', 'disponibilidade_especialidade.id_desponibilidade')
        ->join('medico_clinica_especialidade', 'medico_clinica_especialidade.id_medico_clinica_especialidade', '=', 'disponibilidade_especialidade.id_medico_clinica_especialidade')
        ->join('medico_clinica', 'medico_clinica.id_medico_clinica', '=', 'medico_clinica_especialidade.id_medico_clinica')
        ->join('clinicas', 'clinicas.id_clinica', '=', 'medico_clinica.id_clinica')
        ->where('medico_clinica.id_medico','=', $id_doctor)
        ->where(function($query) use($searchClinic){
             if(isset($searchClinic)){
                $query->where("clinicas.nome", "LIKE", "%{$searchClinic}%");

            }
         })
        ->where(function($query) use($searchSpeciality){
           if(isset($searchSpeciality) && $searchSpeciality != 0){
                  $query->where("medico_clinica_especialidade.id_especialidade", "=", $searchSpeciality);
            }
         })
         ->where(function($query) use($searchData){
            if(isset($searchData)){
                   $query->where("disponibilidades.data_disponivel", "=", $searchData);
             }
          })
          ->groupBy("disponibilidades.id_disponibilidade")
          ->paginate(4);

        return $results;
    }



}

?>
