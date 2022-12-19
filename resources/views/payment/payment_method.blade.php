@extends('layout')

@section('title', 'Saude ON')

@section('content')

    <div class="container-fluid overflow-hidden">
        <div class="row margin-tb-90px margin-lr-100px sm-mrl-0px">
            <!-- Page Title -->
            <div id="page-title" class="padding-30px background-white full-width">
                <div class="container">
                    <ol class="breadcrumb opacity-5">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Add Listing</li>
                    </ol>
                    <h1 class="font-weight-300">Metodo de pagamento</h1>
                </div>
            </div>
            <!-- // Page Title -->

            <form class="form_pay" method="post" action="{{route('create_appointment_clinic')}}">
                @csrf
                <div class=" padding-30px margin-bottom-45px full-width">
                    <div class="padding-30px background-white border-radius-20 box-shadow">
                        <h3><i class="far fa-list-alt margin-right-10px text-main-color"></i>Dados da consulta</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-facebook margin-right-10px"></i>Clinica</label>
                                <input type="text" class="form-control form-control-sm" disabled id="dados_clinic" value="{{isset($clinic) ? $clinic : "sem dados"}}">
                                <input type="hidden" name="id_clinic" value="{{isset($id_clinic) ? $id_clinic : "sem dados"}}">
                            </div>
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-twitter margin-right-10px"></i>Medico</label>
                                <input type="text" class="form-control form-control-sm" disabled id="dados_doctor" value="{{isset($doctor) ? $doctor : "sem dados"}}">
                                <input type="hidden" name="id_doctor" value="{{isset($id_doctor) ? $id_doctor : "sem dados"}}">
                            </div>
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-youtube margin-right-10px"></i>Especialidade</label>
                                <input type="text" class="form-control form-control-sm" disabled id="dados_specialty" value="{{isset($specialty) ? $specialty : "sem dados"}}">
                                <input type="hidden" name="id_specialty" value="{{isset($id_specialty) ? $id_specialty : "sem dados"}}">
                            </div>
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-google-plus-g margin-right-10px"></i>Data da consulta</label>
                                <input type="text"  class="form-control form-control-sm" disabled id="dados_data_cons" value="{{isset($date_appoit) ? $date_appoit : "sem dados"}}">
                                <input type="hidden" name="date_appoint" value="{{isset($date_appoint) ? $date_appoint : "sem dados"}}">
                            </div>
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-whatsapp margin-right-10px"></i>Hora da consulta</label>
                                <input type="text" class="form-control form-control-sm" disabled id="dados_hora_cons" value="{{isset($time_appoint) ? $time_appoint : "sem dados"}}">
                                <input type="hidden" name="time_start" value="{{isset($time_start) ? $time_start : "sem dados"}}">
                                <input type="hidden" name="time_end" value="{{isset($time_end) ? $time_end : "sem dados"}}">
                            </div>
                            <input type="hidden" name="id_user_login" value="{{isset($id_user_login) ? $id_user_login : "sem dados"}}">
                            <input type="hidden" name="id_disp" value="{{isset($id_disp) ? $id_disp : "sem dados"}}">

                        </div>
                    </div>
                </div>



                <div class=" margin-bottom-45px full-width">
                    <div class="padding-30px background-white border-radius-20 box-shadow">
                        <h3><i class="far fa-list-alt margin-right-10px text-main-color"></i>Pagamentos</h3>
                        <hr>
                        <div class="remember">
                            <div class="checkbox">
                                    <label>
                                    <input name="optionsCheckboxes" type="radio" id="payment" value="2">
                                    Pagar na clinica
                                </label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <label>
                                    <input name="optionsCheckboxes" type="radio" id="payment" value="1">
                                    Pagameto online
                                </label>
                            </div>
                        </div>
                        <div id="errorPay" style="color: red;"></div>
                        <input type="hidden" name="pay" id="pay" value="">
                        <p id="preserva">A opcao selecionada, permite ao paciente efectuar a reserva da consulta num prazo de 2 dias. <br/> Passado 2 dias, se o pagamento nao tiver sido efectuado na clinica, a reserva e liminada </p>

                        <div class="row" id="divOnline">
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-facebook margin-right-10px"></i>Clinica</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-twitter margin-right-10px"></i>Medico</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-youtube margin-right-10px"></i>Especialidade</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-google-plus-g margin-right-10px"></i>Data da consulta</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6 margin-bottom-20px">
                                <label><i class="fab fa-whatsapp margin-right-10px"></i>Hora da consulta</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>

                        </div>
                        <button type="submit" id="confirme" class="btn btn-sm btn-primary">confirmar</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <script  src="{{URL::asset('assets/js/clinic_detail.js')}}"></script>

    <script type="text/javascript">
        $("#divOnline").hide();
        $("#preserva").hide();

        $(document).on('change', '.form_pay', function(e){
            e.preventDefault();
            var payment = document.querySelector('input[name="optionsCheckboxes"]:checked').value;
            if(payment == 1){
                $("#errorPay").hide();
                $("#preserva").hide();
                $("#divOnline").show();
                document.getElementById('pay').value = payment;
            }else{
                $("#errorPay").hide();
                $("#divOnline").hide();
                $("#preserva").show();
                document.getElementById('pay').value = payment;
            }

        });

        $('#confirme').click(function (e) {
            var pay = $('#pay').val();
            if (pay == "") {
                e.preventDefault();
                document.getElementById('errorPay').innerHTML = 'Selecione o pagamento';
                var element = document.getElementById("payment");
                element.classList.add("is-invalid");
            }
        });



    </script>

@endsection
