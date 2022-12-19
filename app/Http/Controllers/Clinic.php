<?php

namespace App\Http\Controllers;

use App\Classes\ClinicClass;
use App\Classes\HomeClass;
use App\Classes\UserClass;
use App\Classes\AppointmentClass;
use App\Classes\Enc;
use App\Http\Requests\UpdateClinicRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\ClinicaEspecialidade;
use App\Models\Consulta;
use App\Models\MedicoClinica;
use App\Models\MedicoClinicaEspecialidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Clinic extends Controller
{
    private $clinic;
    private $home;
    private $user;
    private $appointment;
    private $enc;

    public function __construct()
    {
        $this->clinic = new ClinicClass();
        $this->home = new HomeClass();
        $this->user = new UserClass();
        $this->appointment = new AppointmentClass();
        $this->enc = new Enc();
    }


    //==============================================
    public function showClinic(Request $request)
    {
        //Inputs da pesquisa da pagina principal
        $searchSelect = $request->input("searchSelect");
        $searchInput = $request->input("searchInput");
        $search = (isset($_GET['searchInput'])) ? $_GET['searchInput'] : "";

        if (isset($request->pesquisaAjax) && $request->pesquisaAjax == true) {
            /*pesquisa que Retorna requisicao ajax e a view  */
            $clinics = $this->clinic->searchClinic($request);
            return view('clinic.clinic_ajax', [
                'clinics' => $clinics
            ]);
        } elseif (isset($searchSelect) &&  isset($searchInput)) {
            /* pesquisa da pagina principal */
            $clinics = $this->home->searchIndex($request);
            $specialtys = $this->home->getSpecialty();
            return view('clinic.clinics', [
                'clinics' => $clinics,
                'specialtys' => $specialtys,
                'search' => $search,
                'searchSelect' => $searchSelect
            ]);
        } else {

            /* Retorna requisicao tradicional  */
            $clinics = $this->clinic->listAll();
            $specialtys = $this->home->getSpecialty();
            return view('clinic.clinics', [
                'clinics' => $clinics,
                'specialtys' => $specialtys,
                'search' => $search,
                'searchSelect' => $searchSelect
            ]);
        }
    }

    //================================
    /* Retorna detalhes da clinica */
    public function clinicDetail(Request $request, $id_clinic)
    {
        $id_clinic = $this->enc->decrypt($id_clinic);

        if (isset($request->pesquisaAjax) && $request->pesquisaAjax == true) {
            /*pesquisa que Retorna requisicao ajax e a view  detail */

            $searchSpeciality = $request->searchSpeciality;
            $desponibilidade = $this->clinic->searchDoctorClinicAjax($request);
            $disableAppointments = $this->appointment->disableAppointmentClinic($id_clinic);
            return view('clinic.clinic_detail_ajax', [
                'desponibilidade' => $desponibilidade,
                'disableAppointments' => $disableAppointments,
                'searchSpeciality' => $searchSpeciality
            ]);
        } else {

            $clinicDetails = $this->clinic->listDetail($id_clinic);
            $clinicSpecialtys = $this->clinic->clnicSpecialty($id_clinic);
            $disponibilidade = $this->clinic->listDisponibilidade($id_clinic);
            $disableAppointments = $this->appointment->disableAppointmentClinic($id_clinic);
            return view('clinic.clinic_detail', [
                'clinicDetails' => $clinicDetails,
                'clinicSpecialtys' => $clinicSpecialtys,
                'desponibilidade' => $disponibilidade,
                'disableAppointments' => $disableAppointments,

            ]);
        }
    }

    public function showPayment($id_clinic, Request $request)
    {
        $id_clinic = $this->enc->decrypt($id_clinic);
        //dd($request->only(['clinicaModalInput', 'medicoaModalInput', 'especModalInput', 'dt_consult_ModalInput', 'hora_consult_ModalInput']));
        //dd($request->clinicaModalInput);
        //dd($request->all());
        $dados = [
            'clinic' => $request->clinicaModalInput,
            'doctor' => $request->medicoaModalInput,
            'specialty' => $request->especModalInput,
            'date_appoit' => $request->dt_consult_ModalInput,
            'time_appoint' => $request->hora_consult_ModalInput
        ];

        $dados_save_appoint = [
            'id_clinic' => $request->id_clinic_hidden,
            'id_doctor' => $request->id_medico_hidden,
            'id_specialty' => $request->id_esp_hidden,
            'id_user_login' => $request->id_user_login,
            'id_disp' => $request->id_disponibilidade,
            'time_start' => $request->hora_inicio,
            'time_end' => $request->hora_fim,
            'date_appoint' => $request->dt_consulta
        ];


        //session()->put($dados);
        //dd($request->session()->all());

        return view('payment.payment_method', $dados, $dados_save_appoint);
    }

    //==========================Adimin clinic==========================================
    public function showClinicDoctor()
    {

        return view('admin.clinic_doctor');
    }

    public function listDoctor()
    {

        $doctors = $this->clinic->listClincDoctor();
        return response()->json([
            'doctor' => $doctors
        ]);
    }

    //Excluir medico
    public function destroyDoctor($id_doctor)
    {
        $this->clinic->destroyClinicDoctor($id_doctor);
    }

    //pesquisar medicos nas clinicas
    public function searchClinicDoctor($data)
    {
        $searchDoctors = $this->clinic->searchClinicDoctor($data);
        return response()->json([
            'searchDoctor' => $searchDoctors
        ]);
    }

    public function clinicDoctorDetail()
    {
        return view('admin.clinic_doctor_detail');
    }

    public function addClinicDoctor()
    {
        return view('admin.clinic_doctor_add');
    }

    //Especialidades do doctor na clinica
    public function getDoctorDetailSpec($id_doctor)
    {
        $id_clinic = session('clinica')['id_clinica'];
        $doctorClinicSpec = MedicoClinicaEspecialidade::select('especialidades.nome', 'medico_clinica.id_clinica', 'medico_clinica.id_medico')
        ->join('medico_clinica', 'medico_clinica.id_medico_clinica', '=', 'medico_clinica_especialidade.id_medico_clinica')
        ->join('especialidades', 'especialidades.id_especialidade', '=', 'medico_clinica_especialidade.id_especialidade')
        ->where([
            ['medico_clinica.id_clinica', $id_clinic],
            ['medico_clinica.id_medico', $id_doctor]
        ])->get();

        return response()->json([
            'doctorClinicSpec' => $doctorClinicSpec
        ]);
    }

    //pesquisar doctor
    public function searchDoctor($data)
    {
        $result = $this->clinic->searchDoctorToAssociation($data);
        return $result;
    }

    //Especialidades do medico para associar a clinica
    public function DoctorSpecialty($id_doctor)
    {
        $id_clinic = session('clinica')['id_clinica'];
        $clinicIdSpecialty = ClinicaEspecialidade::select('clinica_especialidade.id_especialidade')
            ->where('clinica_especialidade.id_clinica', '=', $id_clinic)
            ->get();

        $results = $this->clinic->selectDoctorSpecialty($id_doctor);
        return response()->json([
            'results' => $results,
            'clinicIdSpecialty' => $clinicIdSpecialty
        ]);
    }

    // Associar medico
    public function associationDoctor(Request $request)
    {
        $id_medico = $request['id_medico'];
        $id_clinic = session('clinica')['id_clinica'];
        $clinicDoctor = MedicoClinica::where([
            ['id_medico', $id_medico],
            ['id_clinica', $id_clinic]
        ])->first();

        if ($clinicDoctor) {
            return response()->json([
                'redirect' => route('add_clinic_doctor'),
                'error' => true
            ]);
        }else{
            $this->clinic->assoctionClinicDoctor($request);
            return response()->json([
                'redirect' => route('clinic_doctor'),
                'error' => false
            ]);
        }

    }

    // view Especialidades da clinica
    public function showClinicSpecialty()
    {
        return view('admin.clinic_specialty');
    }

    //list Especialidades da clinica
    public function listSpecialty()
    {

        $specialtys = $this->clinic->listClinicSpecialty();
        return response()->json([
            'specialty' => $specialtys
        ]);
    }

    //Especialidades para associar
    public function specialtyAssociation()
    {
        $allSpecialtys = $this->clinic->specialtyAssociation();
        return response()->json([
            'allSpecialty' => $allSpecialtys
        ]);
    }

    //pesquisar especiaidade da clinica
    public function searchClinicSpecialty($data)
    {
        $resultSpecialtys = $this->clinic->searchClinicSpec($data);
        return response()->json([
            'resultSpecialty' => $resultSpecialtys
        ]);
    }

    //view adicionar especialidade
    public function addClinicSpecialty()
    {
        return view('admin.clinic_specialty_add');
    }

    //pesquisar especialidades para associar
    public function searchSpecialty($spec)
    {
        $searchSpecialtys = $this->clinic->searchSpecialtyToAssociation($spec);
        return $searchSpecialtys;
    }

    //Associar especialidade a clinica
    public function associationSpecialty(Request $request)
    {

        $id_specialty = $request->id_especialidade;
        $id_clinic = session('clinica')['id_clinica'];

        $clinicSpecialty = ClinicaEspecialidade::where([
            ['id_especialidade',$id_specialty],
            ['id_clinica',$id_clinic]
        ])->first();

        if ($clinicSpecialty) {
            return response()->json([
                'redirect' => route('add_clinic_specialty'),
                'error' => true
            ]);
        }else{
            $this->clinic->assoctionClinicSpecialty($request);
            return response()->json([
                'redirect' => route('clinic_specialty'),
                'error' => false
            ]);
        }



    }

    //Excluir especialidade na clinica
    public function destroySpecialty($id_specialty)
    {
        $this->clinic->destroyClinicSpecialty($id_specialty);
    }

    //==================Admin consultas==================================

    //visao das consultas na clinica
    public function showAppoitment()
    {
        return view('admin.clinic_appointment');
    }

    //lista de consultas marcadas
    public function listAppoitment()
    {
        $clinicAppoitments =$this->clinic->listClinicAppoitment();
        return response()->json([
            'clinicAppoitment' => $clinicAppoitments
        ]);
    }

    public function searchAppoitment($data) {

            $id_clinic = session('clinica')['id_clinica'];
            $resultPatient = Consulta::select('u.nome as nome_user', 'u.email', 'u.celular', 'cl.nome  as nome_clinic', 'md.nome as nome_medico', 'e.nome as nome_espec', 'consultas.hora_inicio', 'consultas.hora_fim', 'consultas.data_consulta', 'consultas.data_marcacao', 'consultas.id_estado')
            ->join('usuarios as md', 'md.id_usuario', '=', 'consultas.id_medico')
            ->join('clinicas as cl', 'cl.id_clinica', '=', 'consultas.id_clinica')
            ->join('especialidades as e', 'e.id_especialidade', '=', 'consultas.id_especialidade')
            ->join('disponibilidades as d', 'd.id_disponibilidade', '=', 'consultas.id_desponibilidade')
            ->join('usuarios as u', 'u.id_usuario', '=', 'consultas.id_usuario')
            ->where('consultas.id_clinica', '=', $id_clinic)
            ->where(function ($query) use ($data) {
                if (isset($data)) {
                    $query->where("u.nome", "LIKE", "%".$data."%");
                    //->orwhere("clinica_especialidade.id_especialidade", "=", $data);
                }
            })->get();

            $resultMedico = Consulta::select('u.nome as nome_user', 'u.email', 'u.celular', 'cl.nome  as nome_clinic', 'md.nome as nome_medico', 'e.nome as nome_espec', 'consultas.hora_inicio', 'consultas.hora_fim', 'consultas.data_consulta', 'consultas.data_marcacao', 'consultas.id_estado')
            ->join('usuarios as md', 'md.id_usuario', '=', 'consultas.id_medico')
            ->join('clinicas as cl', 'cl.id_clinica', '=', 'consultas.id_clinica')
            ->join('especialidades as e', 'e.id_especialidade', '=', 'consultas.id_especialidade')
            ->join('disponibilidades as d', 'd.id_disponibilidade', '=', 'consultas.id_desponibilidade')
            ->join('usuarios as u', 'u.id_usuario', '=', 'consultas.id_usuario')
            ->where('consultas.id_clinica', '=', $id_clinic)
            ->where(function ($query) use ($data) {
                if (isset($data)) {
                    $query->where("md.nome", "LIKE", "%".$data."%");
                    //->orwhere("clinica_especialidade.id_especialidade", "=", $data);
                }
            })->get();

            $resultEspec = Consulta::select('u.nome as nome_user', 'u.email', 'u.celular', 'cl.nome  as nome_clinic', 'md.nome as nome_medico', 'e.nome as nome_espec', 'consultas.hora_inicio', 'consultas.hora_fim', 'consultas.data_consulta', 'consultas.data_marcacao', 'consultas.id_estado')
            ->join('usuarios as md', 'md.id_usuario', '=', 'consultas.id_medico')
            ->join('clinicas as cl', 'cl.id_clinica', '=', 'consultas.id_clinica')
            ->join('especialidades as e', 'e.id_especialidade', '=', 'consultas.id_especialidade')
            ->join('disponibilidades as d', 'd.id_disponibilidade', '=', 'consultas.id_desponibilidade')
            ->join('usuarios as u', 'u.id_usuario', '=', 'consultas.id_usuario')
            ->where('consultas.id_clinica', '=', $id_clinic)
            ->where(function ($query) use ($data) {
                if (isset($data)) {
                    $query->where("e.nome", "LIKE", "%".$data."%");
                    //->orwhere("clinica_especialidade.id_especialidade", "=", $data);
                }
            })->get();

            return response()->json([
                'resultPatient' => $resultPatient,
                'resultMedico' => $resultMedico,
                'resultEspec' => $resultEspec
            ]);




    }

    //==================clinica Perfil =============================

    //view clinic showClinicProfile
    public function showClinicProfile()
    {
        return view('admin.profile');
    }

    //Editar perfil
    public function getClinicProfile()
    {
        $provinces = $this->user->getProvince();
        $profileData = $this->clinic->getValuesClinic();
        return response()->json([
            'profileData' => $profileData,
            'province' => $provinces
        ]);

    }

    //Atualizar perfil
    public function updateClinic(UpdateClinicRequest $request)
    {
        //validacao
        $request->validated();

        $this->clinic->update($request);
    }

    //Atualizar senha
    public function updatePasswordClinic(UpdatePasswordRequest $request)
    {

        //validaca
        $request->validated();

        $current_user = session('clinica');

        if (Hash::check($request->old_password, $current_user->senha)) {

            $current_user->update([
                'senha' => bcrypt($request->new_password)
            ]);

        }
    }
}
