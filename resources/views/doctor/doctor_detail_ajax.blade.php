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
                    $ModalName = isset($searchSpeciality) && $searchSpeciality != 0 &&  session()->has('usuario')  ? "#ModalDadosConsulta" : "";
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
<p style="color:red;">Horarios Indisponiveis para a pesquisa selecionada</p>
@endif
<div class="paginate">
    {{$desponibilidade->links()}}
</div>

<script  src="{{URL::asset('assets/js/doctor_detail.js')}}"></script>
