@extends('layout')

@section('title', 'Saude ON')

@section('content')
<div class="container-fluid overflow-hidden">
    <div class="row margin-tb-90px margin-lr-100px sm-mrl-0px">
        @include('menu_profile')
        <div class="row margin-tb-45px full-width">
            <div class="col-md-12 col-3">

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>Data consulta</th>
                        <th>Hora da consulta</th>
                        <th>Clinica</th>
                        <th>Especialidade</th>
                        <th>Medico</th>
                        <th>Data Marcacao</th>
                        <th>situacao do Agendamento</th>
                        <th>Comprovante</th>
                        <th>Cancelar consulta</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if (isset($appointments) && count($appointments) > 0)
                                @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{$appointment->data_consulta}}</td>
                                <td>{{$appointment->hora_inicio}}-{{$appointment->hora_fim}}</td>
                                <td>{{$appointment->nome_clinic}}</td>
                                <td>{{$appointment->nome_espec}}</td>
                                <td>{{$appointment->nome_medico}}</td>
                                <td>{{$appointment->data_marcacao}}</td>
                                @if ($appointment->id_estado == 1)
                                    <td>Agendado<i class="fa fa-check-circle" style="color: #62b000; font-size: 20px;"></i></td>
                                @else
                                        <td>Reservado<i class="fa fa-check-circle" style="color: #62b000; font-size: 20px;"></i></td>
                                @endif
                                <td><button data-toggle='modal' data-target='#printAppointment'  class="btn btn-info btn-sm"><i class="fa fa-print"></i></button></td>
                                <td><button data-toggle='modal' data-target='#cancelAppointment'  class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button></td>
                            </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    </div>
                    <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->

       <!-- Cancelar  Modal-->
    <div class="modal fade" id="cancelAppointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tem certeza que pretende cancelar a consulta?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
                </div>
                <div class="modal-body">Para cancelar clique no botao confirmar</div>
                <div class="modal-footer">
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancelar</button>
                    <a class='btn btn-primary' href=''>Confirmar</a>
                </div>
            </div>
        </div>
    </div>

      <!-- Print comprovante consulta  Modal-->
      <div class="modal fade" id="printAppointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Imprima (ou fotografe) e leve no dia do procedimento para confirmar seu agendamento.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
                </div>
                <div class="modal-body" id="content">
                    <p><img src="http://placehold.it/60x60" class="border-radius-60" alt="">&nbsp; &nbsp; &nbsp;<span style="font-size: 20px;">Dental dream</span></p>
                    <p>Paciente: &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<span class="font-weight-300">Edilson Nhancale</span></p>
                    <p>Medico: &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<span class="font-weight-300">Frederico Gomes</span></p>
                    <p>Especialidade:&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="font-weight-300">Protese</span></p>
                    <p>Dia da consulta:&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<span class="font-weight-300">06-07-2021-10:30</span></p>
                    <p>Local da consulta:&nbsp; &nbsp; &nbsp;<span class="font-weight-300">Museu</span></p>
                    <p style="text-align: center;">dentaldream@gmail.com</p>


                </div>
                <div id="editor"></div>
                <div class="modal-footer">
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancelar</button>
                    <button class='btn btn-primary' type='button' id="cmd">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var doc = new jsPDF();
        var specialElementHandlers = {
            '#editor': function (element, renderer) {
                return true;
            }
        };

        $('#cmd').click(function () {
            doc.fromHTML($('#content').html(), 15, 15, {
                'width': 170,
                    'elementHandlers': specialElementHandlers
            });
            doc.save('sample-file.pdf');
        });
    </script>

@endsection

