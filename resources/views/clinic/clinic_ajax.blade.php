@if (isset($clinics) && count($clinics) > 0)
<div class="row" >
    <!-- clinic -->
    @foreach($clinics as $clinic)
    <div class="col-md-3 margin-bottom-45px" >

        <div class="background-white thum-hover box-shadow hvr-float">

            <div class="item-thumbnail background-white">
                <a href="{{route('clinic_detail', ['id_clinic' =>$enc->encrypt($clinic->id_clinica)])}}"><img src="assets/img/clinica/{{$clinic->id_clinica}}/logo/{{$clinic->imagem}}" alt=""></a>
            </div>
            <div class="padding-30px">
                <h5 class="margin-bottom-20px"><a class="text-dark" href="#">{{$clinic->nome}}</a></h5>
                <div class="rating clearfix">
                    <span class="float-left text-grey-2"><i class="far fa-map"></i> {{$clinic->nome_provincia}}, {{$clinic->localizacao}}</div>
            </div>
            <div class="padding-lr-30px padding-tb-15px background-light-grey">
                <div class="row no-gutters">
                    <div class="col-8"><a href="#" class="text-lime"><i class="far fa-bookmark"></i> Marcar consulta</a></div>
                    <div class="col-4 text-right"><a href="#" class="text-blue"><i class="far fa-map"></i> mapa!</a></div>
                </div>
            </div>

        </div>

    </div>
    @endforeach

    <!-- // clinic -->
</div>
<!-- // row -->

<div class="paginacao">
    {{$clinics->links()}}
</div>
@endif





