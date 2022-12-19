@extends('layout')

@section('title', 'Saude ON')

@section('content')

@php
    $enc = new App\Classes\Enc();
@endphp

<div class="row no-gutters">
<div class="col-lg-1">
</div>

		<div class="col-lg-10">
			<div class="padding-45px padding-pages">
				<div class="row">
                    <div class="col-md-7 col-6"></div>
				    <!-- Listing Search -->
					<div class="listing-search col-md-5">
						<form class="row no-gutters clinic_form" id="id_form">
							@csrf
							<div class="col-md-8 col-6">
								<div class="keywords">
                                   <input class="listing-form first" type="text"  id="clinicSearch" name="clinicSearch" placeholder="Pesquise a clinica..." value="{{$searchSelect == 1 ? $search : ''}}" >
								</div>
							</div>
							<div class="col-md-4 col-6">
								<select class="form-control form-control-sm"  name="sel_espec" id="sel_espec" style=" height:47px; overflow:auto;">
									<option value="">Especialidades</option>
									@foreach ($specialtys as $specialty)
										<option value="{{$specialty->id_especialidade}}" {{ $search == $specialty->nome ? 'selected' : '' }}>{{$specialty->nome}}</option>
									@endforeach
							</select>
							</div>
							<input type="hidden" id="page" name="page" value="0">
							{{--<div class="col-md-4 col-6">
								<button class="listing-bottom background-dark box-shadow" id="btn_search">Pesquise</button>
							</div>--}}
						</form>
					</div>
			   </div>
				<!-- // Listing Search -->

				<hr>
				<div class="float-left">14 clinicas</div>
				<div class="float-right">

					<a href="map-grid-layout.html" class="text-main-color"><i class="fas fa-th-large"></i></a>
				</div>
				<div class="clearfix"></div>
				<hr>
                <div id="clinic_search_ajax">
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
									<span class="float-left text-grey-2"><i class="far fa-map"></i>
									@if($clinic->provincia)
                                     {{$clinic->provincia->nome}},
                                     @endif
									 {{$clinic->localizacao}}
									</span>

								</div>
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
				@else
                {{-- {{$searchSelect == 1 ? 'Clinica inexistente' : ' Clinica inexistente para especialidade pesquisada'}} --}}
                     @if ($searchSelect == 1)
                        <p style="color: red">Clinica inexistente</p>
                     @else
                     <p style="color: red">Clinica inexistente para especialidade pesquisada</p>
                     @endif

                @endif
				<div class="paginacao">
					{{$clinics->links()}}
				</div>
			</div>
			</div>

			</div>
		</div>
	</div>

	<script  src="{{URL::asset('assets/js/clinic.js')}}"></script>

@endsection


