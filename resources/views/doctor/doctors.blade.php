@extends('layout')

@section('title', 'Saude ON')

@section('content')


<div id="page-title" class="padding-pages gradient-white">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li class="active">Medicos</li>
            </ol>
            <h1 class="font-weight-300">Lista de Médicos</h1>
        </div>
    </div>


    <div class="margin-tb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" id="doctor">
                   @if (isset($doctors) && count($doctors) > 0)
                    <div class="row">
                        <!-- Doctor -->
                        @foreach ($doctors as $doctor)
                            <div class="col-lg-4 col-md-6 hvr-bob margin-bottom-45px">
                                <div class="background-white box-shadow">
                                    <div class="thum">
                                        <a href="{{route('doctor_detail', ['id_doctor' => $doctor->id_usuario])}}"><img src="assets/img/Medico/{{$doctor->id_usuario}}/{{$doctor->imagem}}" alt=""></a>
                                    </div>
                                    <div class="padding-30px">

                                        <h5 class="margin-tb-15px"><a class="text-dark" href="#">Dr.{{$doctor->nome}}</a></h5>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- // Doctor -->
                    </div>
                    @else
                    <p style="color:red;">Médico inexistente</p>
                    @endif
                    <div class="paginacao">
                        {{$doctors->links()}}
                    </div>

                </div>
                <div class="col-lg-4">

                    <div class="background-white border-radius-10 margin-bottom-45px">
                        <div class="padding-25px">
                            <h3 class="margin-lr-20px"><i class="fas fa-search margin-right-10px text-main-color"></i> Filtro de pesquisa</h3>
                            <!-- Listing Search -->
                            <div class="listing-search">
                                <form class="doctor_form" method="post">
                                    @csrf
                                    <div class="keywords margin-bottom-20px">
                                        <input class="listing-form first border-radius-10" name="searchDoctor" id="searchDoctor" type="text" placeholder="Pesquise o medico..." value="{{$search}}">
                                    </div>

                                    <select class="form-control form-control-sm" name="speciality" id="speciality" style=" height:47px; overflow:auto;">
                                        <option value="">Especialidades</option>
                                        @foreach ($specialtys as $specialty)
                                            <option value="{{$specialty->id_especialidade}}">{{$specialty->nome}}</option>
                                        @endforeach
                                   </select>
                                    <input type="hidden" name="page" id="page" value="0">
                                </form>
                            </div>
                            <!-- // Listing Search -->
                        </div>
                    </div>


                    <div class="featured-categorey">
                        <div class="row">
                            <div class="col-6 margin-bottom-30px wow fadeInUp">
                                <a href="#" class="d-block border-radius-15 hvr-float hvr-sh2">
                                    <div class="background-main-color text-white border-radius-15 padding-30px text-center opacity-hover-7">
                                        <div class="icon margin-bottom-15px opacity-7">
                                            <img src="assets/img/icon/categorie-1.png" alt="">
                                        </div>
                                        Medicos
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 margin-bottom-30px wow fadeInUp" data-wow-delay="0.2s">
                                <a href="#" class="d-block border-radius-15 hvr-float hvr-sh2">
                                    <div class="background-main-color text-white border-radius-15 padding-30px text-center opacity-hover-7">
                                        <div class="icon margin-bottom-15px opacity-7">
                                            <img src="assets/img/icon/categorie-2.png" alt="">
                                        </div>
                                        Clinicas
                                    </div>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script  src="{{URL::asset('assets/js/doctor.js')}}"></script>
@endsection

