@extends('layout')

@section('title', 'Saude ON')

@section('content')

<div id="page-title" class="padding-pages gradient-white">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li><a href="#">Clinics</a></li>
                <li class="active">Dental dream</li>
            </ol>
            <h1 class="font-weight-300">{{$doctorDetails->nome}}</h1>
        </div>
    </div>


    <div class="margin-tb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <div class="margin-bottom-30px box-shadow">
                        <center><img src="{{URL::asset('assets/img/Medico/'.$doctorDetails->id_usuario.'/'.$doctorDetails->imagem)}}" alt=""></center>
                        <div class="padding-30px background-white">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="rating clearfix">
                                        <span class="float-left text-grey-2"><i class="far fa-map"></i>
                                            @if($doctorDetails->provincias)
                                            {{$doctorDetails->provincias->nome}}
                                            @endif
                                        </span>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row no-gutters">
                                        <div class="col-4"><a href="#" class="text-lime"><i class="far fa-map"></i> mapa!</a></div>

                                        <div class="col-4 text-right"><a  class="text-blue"><i class="fa fa-user-md"></i>Medico</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

               <!-- Listing Search -->
				<div class="listing-search col-md-12" >
                <div class="row">
					<form class="no-gutters col-md-12 form_search" style="margin-bottom: 2%" id="form_search">
						<div class="col-md-12 col-9">
							<div class="keywords">
								<input class="listing-form first" type="text" name="searchClinic" id="searchClinic"  placeholder="Pesquise a Clinica" value="">
							</div>
						</div>
                        <div class="row" style="margin-top: 5%;">
                            <div class="col-md-6" style="margin-bottom: 2%">
                                <div class="form-group">
                                    <select class="form-control form-control-sm" name="especialidade" id="especialidade" style=" height:47px; overflow:auto;">
                                        <option value="0">Especialidades</option>
                                        @foreach ($doctorSpecialtys as $doctorSpecialty)
                                        @if ($doctorSpecialty->especialidades)
                                                <option value="{{$doctorSpecialty->especialidades->id_especialidade}}">{{$doctorSpecialty->especialidades->nome}}</option>
                                        @endif
                                        @endforeach
                                   </select>
                                   <div id="erroSpecialty" style="color: red;"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    @php
                                        $hoje = date('Y-m-d');

                                    @endphp
                                    <input id="date" type="date" name="date" class="form-control" value="{{$hoje}}">
                                </div>
                            </div>

                        </div>

                    </form>
				</div>
                </div>
				<!-- // Listing Search -->


                </div>
                <div class="col-md-12">

                <div class="margin-bottom-30px box-shadow">
                        <div class="padding-30px background-white">
                           <div class="row">
                                <div class="col-6">
                                    <h3><i class="far fa-star margin-right-10px text-main-color"></i> Horarios desponiveis</h3>
                                </div>
                            </div>
                            <hr>
                            <ul class="commentlist padding-0px margin-0px list-unstyled text-grey-3">
                                <div id="result_search">
                                    @if (isset($desponibilidade) && count($desponibilidade) > 0)
                                    @foreach($desponibilidade as $despValue)
                                    <li class="border-bottom-1 border-grey-1 margin-bottom-20px">
                                        <img src="http://placehold.it/60x60" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt="">
                                        <div class="margin-left-85px">
                                            <a class="d-inline-block text-dark text-medium margin-right-20px" href="#">{{$despValue->nome}}</a>
                                            <span class="text-extra-small">Date :  <a href="#" class="text-main-color">{{$despValue->data_disponivel}}</a></span>

                                            <p class="margin-top-15px text-grey-2">
                                                @php
                                                    $ModalName = "";
                                                    //verificando se a especialidade e diferente de 0 e se existe a sessao
                                                    $ModalName = isset($_GET['especialidade']) && $_GET['especialidade'] != 0 &&  session()->has('usuario')  ? "#ModalDadosConsulta" : "";
                                                    //echo $ModalName;
                                                    $hora_inicio = $despValue->hora_inicio;
                                                    $hora_fim = $despValue->hora_fim;
                                                    $duracao = $despValue->duracao;

                                                    $hora_inicioWhile = str_replace(":", "",$hora_inicio);
                                                    $hora_fimGeral = str_replace(":", "", $hora_fim);
                                                    $hora_inicioDisp = $hora_inicio;

                                                    $hora_fimDisp = date('H:i', strtotime("{$hora_inicioDisp} + $duracao minutes"));

                                                    $hora_fimWhile = $hora_fimDisp;
                                                    $hora_fimWhile = str_replace(":", "",$hora_fimWhile);



                                                    while ($hora_fimWhile <= $hora_fimGeral) {

                                                        if (!session()->has('usuario')) {//verificando se existe sessao
                                                            $ModalName = "#ModalLogin";
                                                        }
                                                        $desablebutton ="";
                                                        if (isset($disableAppointments) && count($disableAppointments) > 0) { // dados para desabilitar a consulta
                                                            foreach ($disableAppointments as $disable) {
                                                                $disable_hora_inicio = $disable->hora_inicio;
                                                                $disable_hora_fim = $disable->hora_fim;
                                                                $disable_id_disponibilidade = $disable->id_desponibilidade;
                                                                $desablebutton = "";
                                                                    // verificando os dados das consultas disponiveis e agendadas

                                                                if ( $disable_hora_inicio == $hora_inicioDisp
                                                                    &&  $disable_hora_fim == $hora_fimDisp
                                                                    &&  $disable_id_disponibilidade == $despValue->id_disponibilidade
                                                                    ) {
                                                                        $desablebutton = "disabled";
                                                                        break;
                                                                }
                                                            }
                                                        }

                                                        $Test = "<button type='button' {$desablebutton} class='btn btn-sm botao-horario-consulta' data-toggle='modal' data-target='{$ModalName}' style='margin-bottom: 10px' value='{$despValue->nome};".$hora_inicioDisp."-".$hora_fimDisp.";{$despValue->data_disponivel};{$ModalName};{$despValue->id_clinica};{$despValue->id_disponibilidade};".$hora_inicioDisp.";".$hora_fimDisp."'>  ".$hora_inicioDisp."-".$hora_fimDisp."</button>";

                                                        echo  $Test.' ';

                                                        $hora_inicioDisp = $hora_fimDisp;
                                                        $hora_fimDisp = date('H:i', strtotime("{$hora_inicioDisp} + $duracao minutes"));
                                                        $hora_fimWhile = $hora_fimDisp;

                                                        $hora_fimWhile = str_replace(":", "",$hora_fimWhile);


                                                }
                                                @endphp


                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                                 @else
                                    <p style="color:red;">Horarios Indisponiveis para a data currente, por favor altere a data</p>
                                @endif
                                <div class="paginate">
                                    {{$desponibilidade->links()}}
                                </div>
                                </div>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalDadosConsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pretende marcar a consulta com os dados abaixo?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                    </div>

                    <form method="post" action="{{route('payment_doctor', ['id_doctor' => $doctorDetails->id_usuario])}}">
                        @csrf
                    <div class="modal-body">

                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body">

                              <table id='example1' class='table table-bordered table-striped'> <thead>  </thead><tr><td>Clinica</td><td id="clinicaModal"></td></tr><tr><td>Medico</td><td id="medicoaModal"></td></tr> <tr><td>Especialidade</td><td id="especModal"></td></tr><tr><td>Data da consulta</td><td id="dt_consult_Modal"></td></tr><tr> <td>Hora da consulta</td><td id="hora_consult_Modal"></td></tr><tbody> </tbody></table>

                                <input type="text" name="medicoInput" id="medicoInput" value="{{$doctorDetails->nome}}">
                                <input type="text" name="clinicInput" id="clinicInput" value="">
                                <input type="text" name="especInput" id="especInput" value="">
                                <input type="text" name="dt_consult_Input" id="dt_consult_Input" value="">
                                <input type="text" name="hora_consult_Input" id="hora_consult_Input" value="">

                              @if (session()->has('usuario'))
                                <input type="hidden" name="hiddenDoctor" id="hiddenDoctor" value="{{$doctorDetails->nome}}">
                                <input type="hidden" name="id_medico_hidden" id="id_medico_hidden" value="{{$doctorDetails->id_usuario}}">
                                <input type="hidden" name="id_clinic_hidden" id="id_clinic_hidden" value="">
                               <input type="hidden" name="id_esp_hidden" id="id_esp_hidden" value="">
                                <input type="hidden" name="id_user_login" id="id_user_login" value="{{session('usuario')['id_usuario']}}">
                               <input type="hidden" name="id_disponibilidade" id="id_disponibilidade" value="">
                               <input type="hidden" name="hora_inicio" id="hora_inicio" value="">
                                <input type="hidden" name="hora_fim" id="hora_fim" value="">
                                <input type="hidden" name="dt_consulta" id="dt_consulta" value="">
                                @endif

                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="modal-footer" id="botoesModal">
                        <button class='btn btn-secondary' type='button' data-dismiss='modal' onClick='Cancel();'>Cancelar</button>
                         <button type="submit" class='btn btn-primary'>Confirmar</button>

                    </div>
                </form>
                </div>
            </div>
        </div>

           <!-- Logout Modal-->
           <div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pretende efectuar o login?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                    </div>
                    <div class="modal-body">Para agendar uma consulta médica é necessario efectuar o login</div>
                    <div class="modal-footer">
                        <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancelar</button>
                        <a class='btn btn-primary' href='{{route('login')}}'>Logar</a>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="hiddenDoctor" id="hiddenDoctor" value="{{$doctorDetails->nome}}">
    <script  src="{{URL::asset('assets/js/doctor_detail.js')}}"></script>


@endsection
