<?php

namespace App\Http\Controllers;

use App\Classes\DoctorClass;
use App\Classes\HomeClass;
use App\Classes\AppointmentClass;
use Illuminate\Http\Request;

class Doctor extends Controller
{
    private $doctor;
    private $home;
    private $appointment;

    public function __construct()
    {
        $this->doctor = new DoctorClass();
        $this->home = new HomeClass();
        $this->appointment = new AppointmentClass();
    }

    public function showDoctor(Request $request)
    {
        //Inputs da pesquisa da pagina principal
        $earchSelect = $request->input("searchSelect");
        $searchInput = $request->input("searchInput");
        $search = (isset($_GET['searchInput'])) ? $_GET['searchInput'] : "";

        if (isset($request->pesquisaAjax) && $request->pesquisaAjax == true) {
            /*pesquisa que Retorna requisicao ajax e a view  */
            $doctors = $this->doctor->searchDoctor($request);
            return view('doctor.doctor_ajax', [
                'doctors' => $doctors
            ]);
        } elseif (isset($earchSelect) &&  isset($searchInput)) {
            /* pesquisa da pagina principal */
            $doctors = $this->home->searchIndex($request);
            $specialtys = $this->home->getSpecialty();
            return view('doctor.doctors', [
                'specialtys' => $specialtys,
                'doctors' => $doctors,
                'search' => $search

            ]);
        } else {

            $doctors = $this->doctor->listAll();
            $specialtys = $this->home->getSpecialty();
            return view('doctor.doctors', [
                'specialtys' => $specialtys,
                'doctors' => $doctors,
                'search' => $search

            ]);
        }
    }

    public function doctorDetail(Request $request, $id_doctor)
    {

        if (isset($request->pesquisaAjax) && $request->pesquisaAjax == true) {
            /*pesquisa que Retorna requisicao ajax e a view  detail */
            $searchSpeciality = $request->searchSpeciality;
            $desponibilidade = $this->doctor->searchClinicDoctorAjax($request);
            $disableAppointments = $this->appointment->disableAppointmentDoctor($id_doctor);
            return view('doctor.doctor_detail_ajax', [
                'desponibilidade' => $desponibilidade,
                'disableAppointments' => $disableAppointments,
                'searchSpeciality' => $searchSpeciality
            ]);
        } else {

            $doctorDetails = $this->doctor->listDetail($id_doctor);
            $doctorSpecialtys = $this->doctor->DoctorSpecialty($id_doctor);
            $desponibilidade = $this->doctor->listDisponibilidade($id_doctor);
            $disableAppointments = $this->appointment->disableAppointmentDoctor($id_doctor);
            //dd($disponibilidades);
            return view('doctor.doctor_detail', [
                'doctorDetails' => $doctorDetails,
                'doctorSpecialtys' => $doctorSpecialtys,
                'desponibilidade' => $desponibilidade,
                'disableAppointments' => $disableAppointments
            ]);
        }
    }

    public function showPayment(Request $request)
    {
        //dd($request->all());
        $dados = [
            'clinic' => $request->clinicInput,
            'doctor' => $request->medicoInput,
            'specialty' => $request->especInput,
            'date_appoit' => $request->dt_consult_Input,
            'time_appoint' => $request->hora_consult_Input
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
        return view('payment.payment_doctor',  $dados, $dados_save_appoint);
    }
}
