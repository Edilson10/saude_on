<?php

namespace App\Classes;

use App\Models\Consulta;
use Illuminate\Http\Request;

class AppointmentClass
{
    //inserir consultas
    public function saveAppointment(Request $request)
    {
        $appointment = new Consulta();
        $appointment->id_clinica = $request->input('id_clinic');
        $appointment->id_medico = $request->input('id_doctor');
        $appointment->id_especialidade = $request->input('id_specialty');
        $appointment->id_usuario = $request->input('id_user_login');
        $appointment->id_desponibilidade = $request->input('id_disp');
        $appointment->hora_inicio = $request->input('time_start');
        $appointment->hora_fim = $request->input('time_end');
        $appointment->data_consulta = $request->input('date_appoint');
        $appointment->id_estado = $request->input('pay');
        $appointment->save();
    }

    //listar consultas
    public function listAppointment()
    {
        $userSession = session('usuario')['id_usuario'];

        $results = Consulta::select('u.nome as nome_user', 'cl.nome  as nome_clinic', 'md.nome as nome_medico', 'e.nome as nome_espec', 'consultas.hora_inicio', 'consultas.hora_fim', 'consultas.data_consulta', 'consultas.data_marcacao', 'consultas.id_estado')
            ->join('usuarios as md', 'md.id_usuario', '=', 'consultas.id_medico')
            ->join('clinicas as cl', 'cl.id_clinica', '=', 'consultas.id_clinica')
            ->join('especialidades as e', 'e.id_especialidade', '=', 'consultas.id_especialidade')
            ->join('disponibilidades as d', 'd.id_disponibilidade', '=', 'consultas.id_desponibilidade')
            ->join('usuarios as u', 'u.id_usuario', '=', 'consultas.id_usuario')
            ->where('u.id_usuario', '=', $userSession)
            ->get();
        //dd($results);
        return $results;
    }

    //disailitar consultas marcadas nas clinica
    public function disableAppointmentClinic($id_clinic)
    {
        $dataAtual = date('Y-m-d');
        $results = Consulta::select('consultas.id_desponibilidade', 'consultas.hora_fim', 'consultas.hora_inicio', 'consultas.data_consulta', 'consultas.id_clinica')
            ->join('disponibilidades', 'disponibilidades.id_disponibilidade', '=', 'consultas.id_desponibilidade')
            ->where([
                ['consultas.id_clinica', '=', $id_clinic],
                ['disponibilidades.data_disponivel', '>=', $dataAtual]

            ])
            ->get();
        //dd($results);
        return $results;
    }

    //disailitar consultas marcadas nos medicos
    public function disableAppointmentDoctor($id_doctor)
    {
        $dataAtual = date('Y-m-d');
        $results = Consulta::select('consultas.id_desponibilidade', 'consultas.hora_fim', 'consultas.hora_inicio', 'consultas.data_consulta', 'consultas.id_clinica')
            ->join('disponibilidades', 'disponibilidades.id_disponibilidade', '=', 'consultas.id_desponibilidade')
            ->where([
                ['consultas.id_clinica', '=', $id_doctor],
                ['disponibilidades.data_disponivel', '>=', $dataAtual]

            ])
            ->get();
        //dd($results);
        return $results;
    }
}
