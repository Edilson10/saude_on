<?php

namespace App\Classes;

use App\Models\Clinica;
use App\Models\ClinicaEspecialidade;
use App\Models\Disponibilidade;
use App\Models\DisponibilidadeEspecialidade;
use App\Classes\Enc;
use App\Models\Consulta;
use App\Models\Provincia;
use App\Models\Horario;
use App\Models\Especialidade;
use App\Models\Usuario;
use App\Models\MedicoClinica;
use App\Models\MedicoClinicaEspecialidade;
use App\Models\MedicoEspecialidade;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;


class ClinicClass
{

    public function __construct()
    {
        $this->enc = new Enc();
    }

    //listar Clininas
    public function listAll()
    {
        $results = Clinica::with('horarios', 'provincia')->paginate(12);

        return $results;
    }

    //listar detalhes das Clininas
    public function listDetail($id_clinic)
    {

        $clinicDetail = Clinica::with('horarios', 'provincia')->find($id_clinic);
        return $clinicDetail;
    }

    //listar disponibilidades das clinicas
    public function listDisponibilidade($id_clinic)
    {
        $dataAtual = date('Y-m-d');
        $clinicDisp = Disponibilidade::select('disponibilidades.*', 'usuarios.*')
            ->join('medico_clinica', 'medico_clinica.id_medico_clinica', '=', 'disponibilidades.id_medico_clinica')
            ->join('usuarios', 'usuarios.id_usuario', '=', 'medico_clinica.id_medico')
            ->where([
                ['medico_clinica.id_clinica', '=', $id_clinic],
                ['data_disponivel', '=', $dataAtual]
            ])->paginate(4);
        // dd($clinicDisp);

        return $clinicDisp;
    }

    //Especialidades das  Clininas
    public function clnicSpecialty($id_clinic)
    {
        $clinicSpecialtys = ClinicaEspecialidade::with('clinicas', 'especialidades')->where('id_clinica', $id_clinic)->get();
        return $clinicSpecialtys;
    }

    // Pesquisa das clinicas com  ajax
    public function searchClinic(Request $request)
    {

        $searchClinic = $request->clinicSearch;
        $especialidade = $request->especialidade;
        $results = ClinicaEspecialidade::select('clinicas.*', 'provincias.nome as nome_provincia')
            ->join('clinicas', 'clinicas.id_clinica', '=', 'clinica_especialidade.id_clinica')
            ->join('provincias', 'provincias.id_provincia', '=', 'clinicas.id_provincia')
            ->where(function ($query) use ($searchClinic) {
                if (isset($searchClinic)) {
                    $query->where("clinicas.nome", "LIKE", "%{$searchClinic}%")
                        ->orwhere("clinicas.localizacao", "LIKE", "%{$searchClinic}%")
                        ->orwhere("provincias.nome", "LIKE", "%{$searchClinic}%");
                }
            })
            ->where(function ($query) use ($especialidade) {
                if (isset($especialidade)) {
                    $query->where("clinica_especialidade.id_especialidade", "=", $especialidade);
                }
            })->groupBy('clinicas.id_clinica')
            ->paginate(12);

        return $results;
    }

    //pesquisando medicos nas clinicas com ajax
    public function searchDoctorClinicAjax(Request $request)
    {
        $searchDoctor = $request->searchDoctor;
        $searchSpeciality = $request->searchSpeciality;
        $id_clinic = $request->id_clinic;
        $searchData = $request->searchData;


        $results = DisponibilidadeEspecialidade::select('disponibilidades.*', 'usuarios.nome', 'usuarios.id_usuario', 'medico_clinica.id_clinica', 'medico_clinica_especialidade.id_especialidade')
            ->join('disponibilidades', 'disponibilidades.id_disponibilidade', '=', 'disponibilidade_especialidade.id_desponibilidade')
            ->join('medico_clinica_especialidade', 'medico_clinica_especialidade.id_medico_clinica_especialidade', '=', 'disponibilidade_especialidade.id_medico_clinica_especialidade')
            ->join('medico_clinica', 'medico_clinica.id_medico_clinica', '=', 'medico_clinica_especialidade.id_medico_clinica')
            ->join('usuarios', 'usuarios.id_usuario', '=', 'medico_clinica.id_medico')
            ->where('medico_clinica.id_clinica', '=', $id_clinic)
            ->where(function ($query) use ($searchDoctor) {
                if (isset($searchDoctor)) {
                    $query->where("usuarios.nome", "LIKE", "%{$searchDoctor}%");
                }
            })
            ->where(function ($query) use ($searchSpeciality) {
                if (isset($searchSpeciality) && $searchSpeciality != 0) {
                    $query->where("medico_clinica_especialidade.id_especialidade", "=", $searchSpeciality);
                }
            })
            ->where(function ($query) use ($searchData) {
                if (isset($searchData)) {
                    $query->where("disponibilidades.data_disponivel", "=", $searchData);
                }
            })

            ->groupBy("disponibilidades.id_disponibilidade")
            ->paginate(4);

        return $results;
    }

    //=========================Admin============================

    //listar medicos nas clinicas
    public function listClincDoctor()
    {
        $id_clinic = session('clinica')['id_clinica'];
        $results = MedicoClinica::select('usuarios.*', 'provincias.nome as provincia', 'estado.nome as estado', 'medico_clinica.id_medico_clinica')
            ->join('clinicas', 'clinicas.id_clinica', '=', 'medico_clinica.id_clinica')
            ->join('usuarios', 'usuarios.id_usuario', '=', 'medico_clinica.id_medico')
            ->join('provincias', 'provincias.id_provincia', '=', 'usuarios.id_provincia')
            ->join('estado', 'estado.id_estado', '=', 'medico_clinica.id_estado')
            ->where('medico_clinica.id_clinica', $id_clinic)
            ->get();

        //dd($results);
        return $results;
    }

    //Eliminar medicos na clinica
    public function destroyClinicDoctor($id_doctor)
    {
        $deleteDoctorSpec = MedicoClinicaEspecialidade::where('id_medico_clinica', $id_doctor);
        $deleteDoctorSpec->delete();

        $id_clinic = session('clinica')['id_clinica'];
        $deleteDoctor = MedicoClinica::where([
            ['id_medico_clinica', $id_doctor],
            ['id_clinica', $id_clinic]
        ]);
        $deleteDoctor->delete();
    }

    //pesquisar medicos na clinica
    public function searchClinicDoctor($data)
    {
        $id_clinic = session('clinica')['id_clinica'];
        $results = MedicoClinica::select('usuarios.*', 'provincias.nome as provincia', 'estado.nome as estado')
            ->join('clinicas', 'clinicas.id_clinica', '=', 'medico_clinica.id_clinica')
            ->join('usuarios', 'usuarios.id_usuario', '=', 'medico_clinica.id_medico')
            ->join('provincias', 'provincias.id_provincia', '=', 'usuarios.id_provincia')
            ->join('estado', 'estado.id_estado', '=', 'medico_clinica.id_estado')
            ->where('medico_clinica.id_clinica', $id_clinic)
            ->where('usuarios.nome', 'LIKE', '%' . $data . '%')
            ->orwhere('medico_clinica.id_medico', '=', $data)
            ->groupBy('medico_clinica.id_clinica')
            ->get();

            return $results;
    }

    //pesquisar doctor para associar a clinica
    public function searchDoctorToAssociation($data)
    {
        $result = Usuario::where('usuarios.id_tipo_usuario', '=', 1)
        ->where(function ($query) use ($data) {
            if (isset($data)) {
                $query->where('usuarios.nome', 'LIKE', '%' . $data . '%')
                ->orwhere("usuarios.id_usuario", "=", $data);
            }
        })->get();

        return $result;
    }

    //Especialidades do doctor
    public function selectDoctorSpecialty($id_doctor)
    {
        $results = MedicoEspecialidade::select('especialidades.nome', 'medico_especialidade.id_medico', 'medico_especialidade.id_especialidade')
            ->join('especialidades', 'especialidades.id_especialidade', '=', 'medico_especialidade.id_especialidade')
            ->where('medico_especialidade.id_medico', $id_doctor)
            ->get();

        return $results;
    }

    //Associar medico a clinica
    public function assoctionClinicDoctor(Request $request)
    {

        $id_clinic = session('clinica')['id_clinica'];
        $id_medico = $request['id_medico'];
        $id_estado = 1;
        $dataInicio = date('Y-m-d');

        $medico_clinica =  new MedicoClinica();
        $medico_clinica->id_medico = $id_medico;
        $medico_clinica->id_clinica =  $id_clinic;
        $medico_clinica->id_estado = $id_estado;
        $medico_clinica->data_inicio_contrato = $dataInicio;
        $medico_clinica->data_fim_contrato =   $dataInicio;
        $medico_clinica->save();


        $id_medico_clinica = $medico_clinica->id_medico_clinica;
        $id_especialidades[] = $request['id_especialidade'];
        foreach ($request->id_especialidade as $id_especialidadeItem => $id_especialidades) {
            $dados = [
                'id_medico_clinica' => $id_medico_clinica,
                'id_estado' => $id_estado,
                'id_especialidade' =>  $request->id_especialidade[$id_especialidadeItem]
            ];

            MedicoClinicaEspecialidade::insert($dados);
        }
    }

    //Todas especialidades para associar
    public function specialtyAssociation()
    {
        $results = Especialidade::get();
        return $results;
    }

    //litar especialidades na clinica
    public function listClinicSpecialty()
    {
        $id_clinic = session('clinica')['id_clinica'];
        $results = ClinicaEspecialidade::select('especialidades.nome', 'clinica_especialidade.id_especialidade', 'clinica_especialidade.id_clinica', 'clinica_especialidade.id_clinica_especialidade')
        ->join('especialidades', 'especialidades.id_especialidade', '=', 'clinica_especialidade.id_especialidade')
        ->where('clinica_especialidade.id_clinica', $id_clinic)
        ->get();
        return $results;
    }

    //pesquisar especialidades na clinica
    public function searchClinicSpec($data)
    {
        $id_clinic = session('clinica')['id_clinica'];
        $results = ClinicaEspecialidade::select('especialidades.nome', 'clinica_especialidade.id_especialidade', 'clinica_especialidade.id_clinica')
        ->join('especialidades', 'especialidades.id_especialidade', '=', 'clinica_especialidade.id_especialidade')
        ->where('clinica_especialidade.id_clinica', $id_clinic)
        ->where(function ($query) use ($data) {
            if (isset($data)) {
                $query->where("especialidades.nome", "LIKE", "%".$data."%")
                ->orwhere("clinica_especialidade.id_especialidade", "=", $data);
            }
        })->get();

        return $results;

    }

    // pesquisar especialidade para associar a clinica
    public function searchSpecialtyToAssociation($spec)
    {
        $results = Especialidade::where('especialidades.nome', 'LIKE', '%' . $spec . '%')
            ->orwhere('especialidades.id_especialidade', '=', $spec)
            ->get();
        return $results;
    }

    //Associar especialidade a clinica
    public function assoctionClinicSpecialty(Request $request)
    {
        $specialty = new ClinicaEspecialidade();
        $specialty->id_clinica = session('clinica')['id_clinica'];
        $specialty->id_especialidade = $request->id_especialidade;
        $specialty->save();
    }

    //Eliminar especialidade na clinica
    public function destroyClinicSpecialty($id_specialty)
    {
        $clinicSpec = ClinicaEspecialidade::findOrfail($id_specialty);
        $clinicSpec->delete();
    }

    //================consultas ===========================
    public function listClinicAppoitment()
    {
        $id_clinic = session('clinica')['id_clinica'];
       // $dataAtual = date('Y-m-d');
        $results = Consulta::select('u.nome as nome_user', 'u.email', 'u.celular', 'cl.nome  as nome_clinic', 'md.nome as nome_medico', 'e.nome as nome_espec', 'consultas.hora_inicio', 'consultas.hora_fim', 'consultas.data_consulta', 'consultas.data_marcacao', 'consultas.id_estado')
        ->join('usuarios as md', 'md.id_usuario', '=', 'consultas.id_medico')
        ->join('clinicas as cl', 'cl.id_clinica', '=', 'consultas.id_clinica')
        ->join('especialidades as e', 'e.id_especialidade', '=', 'consultas.id_especialidade')
        ->join('disponibilidades as d', 'd.id_disponibilidade', '=', 'consultas.id_desponibilidade')
        ->join('usuarios as u', 'u.id_usuario', '=', 'consultas.id_usuario')
        ->where('consultas.id_clinica', '=', $id_clinic)
        ->get();

        return $results;
    }


    //=======================Perfil ======================
    //retornando dados da clinica
    public function getValuesClinic()
    {
        $userSession = session('clinica')['id_usuario'];
        $results = Usuario::select('usuarios.*', 'pr.nome as nome_pr', 'pr.id_provincia')
            ->join('provincias as pr', 'pr.id_provincia', '=', 'usuarios.id_provincia')
            ->where('id_usuario',  $userSession)
            ->get();
        return $results;
    }

    //Atualizar dados da clinica
    public function update(Request $request)
    {
        $clinic = Usuario::find($request['id_usuario']);
        $clinic->nome = $request['nome'];
        $clinic->email = $request['email'];
        $clinic->celular = $request['celular'];
        $clinic->id_provincia = $request['id_provincia'];
        $clinic->save();
    }
}
