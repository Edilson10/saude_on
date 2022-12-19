<?php

namespace App\Http\Controllers;

use App\Classes\AppointmentClass;
use App\Classes\Enc;
use Illuminate\Http\Request;

class Appointment extends Controller
{
    private $appointment;
    private $enc;

    public function __construct()
    {
        $this->appointment = new AppointmentClass();
        $this->enc = new Enc();
    }

    public function showAppointment()
    {
        $appointments = $this->appointment->listAppointment();
        return view('appointment.appointment', [
            'appointments' => $appointments
        ]);
    }


    public function createAppointmentClinic(Request $request)
    {
        $this->appointment->saveAppointment($request);
        return redirect()->route('clinic_detail', ['id_clinic' =>  $this->enc->encrypt($request->input('id_clinic'))])->with('message', 'Consulta marcada com suceso');
    }

    public function createAppointmentDoctor(Request $request)
    {
        $this->appointment->saveAppointment($request);
        return redirect()->route('doctor_detail', ['id_doctor' =>  $request->input('id_doctor')])->with('message', 'Consulta marcada com suceso');
    }
}
