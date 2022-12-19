<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
     return view('welcome');
 });
*/


Route::get('/', 'Home@home')->name('home');
Route::get('/entrar', 'Login@showLogin')->name('login');
Route::get('/registrar', 'Login@sign')->name('sign');
Route::get('/medico', 'Doctor@showDoctor')->name('doctor');
Route::get('/medico/detalhes/{id_doctor}', 'Doctor@doctorDetail')->name('doctor_detail');
Route::get('/clinica', 'Clinic@showClinic')->name('clinic');
Route::get('/clinica/detalhes/{id_clinic}', 'Clinic@clinicDetail')->name('clinic_detail');
Route::post('/entrarSubmit', 'Login@loginSubmit')->name('login_submit');
Route::post('/registrar', 'Login@register')->name('register');
Route::middleware('checksession')->group(function () {
    Route::get('/sair', 'Login@logout')->name('logout');
    Route::get('/consultas_agendadas', 'Appointment@showAppointment')->name('show_appointment');
    Route::get('/perfil', 'User@showProfile')->name('show_profile');
    Route::post('/Atualizar_perfil', 'User@updateUser')->name('update_user');
    Route::post('/Aterar_senha', 'User@updatePassword')->name('update_password');
    Route::post('/marcar_consulta_clinica', 'Appointment@createAppointmentClinic')->name('create_appointment_clinic');
    Route::post('/marcar_consulta_medico', 'Appointment@createAppointmentDoctor')->name('create_appointment_doctor');
    Route::post('/clinica/detalhes/{id_clinic}/pagamento', 'Clinic@showPayment')->name('payment');
    Route::post('/medico/detalhes/{id_doctor}/pagamento', 'Doctor@showPayment')->name('payment_doctor');
});

//================================clinic Admin============================================
Route::get('/admin/login', 'Admin@showLogin')->name('admin_login');
Route::post('/admin/login', 'Admin@loginSubmit')->name('admin_loginSubmit');
Route::middleware('checkSessionAdmin')->group(function () {
    Route::get('/admin', 'Admin@admin')->name('admin');
    Route::get('/admin/sair', 'Admin@logout')->name('admin_logout');

    Route::get('/admin/medicos', 'Clinic@showClinicDoctor')->name('clinic_doctor');
    Route::get('/admin/medicos/list', 'Clinic@listDoctor')->name('list_clinic_doctor');
    Route::get('/admin/medicos/pesquisar/{data}', 'Clinic@searchClinicDoctor')->name('search_clinic_doctor');

    Route::get('/admin/medicos/detalhes', 'Clinic@clinicDoctorDetail')->name('clinic_doctor_detail');
    Route::get('/admin/medicos/detalhes/especialidades/{id_doctor}', 'Clinic@getDoctorDetailSpec')->name('get_doctor_detail');

    Route::get('/admin/medicos/associar', 'Clinic@addClinicDoctor')->name('add_clinic_doctor');
    Route::get('/admin/medicos/associar/pesquisa/{data}', 'Clinic@searchDoctor')->name('search_doctor');
    Route::get('/admin/medicos/associar/especialidades/{id_doctor}', 'Clinic@DoctorSpecialty')->name('doctor_specialty');

    Route::get('/admin/especialidades', 'Clinic@showClinicSpecialty')->name('clinic_specialty');
    Route::get('/admin/especialidades/list', 'Clinic@listSpecialty')->name('list_clinic_specialty');
    Route::get('/admin/especialidades/pesquisar/{data}', 'Clinic@searchClinicSpecialty')->name('search_clinic_specialty');
    Route::get('/admin/especialidades/associar', 'Clinic@addClinicSpecialty')->name('add_clinic_specialty');
    Route::get('/admin/especialidades/associar/todas', 'Clinic@specialtyAssociation')->name('specialty_association');
    Route::get('/admin/especialidades/associar/pesquisa/{spec}', 'Clinic@searchSpecialty')->name('search_specialty');

    Route::get('/admin/consultas', 'Clinic@showAppoitment')->name('clinic_appoitment');
    Route::get('/admin/consultas/listar', 'Clinic@listAppoitment')->name('list_appoitment');
    Route::get('/admin/consultas/pesquisar/{data}', 'Clinic@searchAppoitment')->name('search_appoitment');

    Route::delete('/admin/especialidades/apagar/{id_specialty}', 'Clinic@destroySpecialty')->name('destroy_specialty');
    Route::delete('/admin/medicos/apagar/{id_doctor}', 'Clinic@destroyDoctor')->name('destroy_doctor');

    Route::post('/admin/medicos/associar', 'Clinic@associationDoctor')->name('ass_clinic_doctor');
    Route::post('/admin/especialidades/associar', 'Clinic@associationSpecialty')->name('ass_clinic_specialty');

    Route::get('/admin/perfil', 'Clinic@showClinicProfile')->name('show_clinic_profile');
    Route::get('/admin/perfil/dados', 'Clinic@getClinicProfile')->name('clinic_profile');
    Route::post('/admin/perfil/atualizar', 'Clinic@updateClinic')->name('update_clinic');
    Route::post('/admin/perfil/atualizar_senha', 'Clinic@updatePasswordClinic')->name('update_password_clinic');
});
