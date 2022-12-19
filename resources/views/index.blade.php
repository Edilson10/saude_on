@extends('layout')

@section('title', 'Saude ON')

@section('content')

    <section class="banner padding-tb-200px sm-ptb-80px background-overlay" style="background-image: url(assets/img/principal.jpg);">
        <div class="container z-index-2 position-relative">
            <div class="title">
                <h1 class="text-title-large text-main-color font-weight-300 margin-bottom-15px">Agende a sua consulta</h1>
                <h4 style="color:black;" class="font-weight-300 text-main-color text-up-small">Marque a sua consuta de forma rapida, dinamica e segura</h4>
            </div>
            <div class="row margin-tb-60px">
                <div class="col-lg-8">
                    <div class="listing-search">
                        @php

                        @endphp
                        <form class="row no-gutters" id="form_index" name="form_index"  method="get" >
                            <div class="col-md-4">
                                <div class="keywords">
                                    <input class="listing-form first" name="searchInput" id="searchInput" type="text" placeholder="Pesquisa" value="">
                                </div>
                                <div ><small id="erroInput" style="color: red;"></small></div>
                            </div>

                            <div class="col-md-5">
                                <select class="form-control form-control-sm"  name="searchSelect" id="searchSelect"  style=" height:47px; overflow:auto;">
                                    <option value="0" disabled selected>------O que deseja pesquisar?---------</option>
                                    <option value="1">Clinicas</option>
                                    <option value="2">Medicos</option>
                                    <option value="3">Especialidades</option>
                                </select>
                                <div ><small id="erroSelect" style="color: red;"></small></div>
                            </div>

                            <div class="col-md-3">
                                <button class="listing-bottom background-second-color box-shadow" name="submit" type="submit" id="submit">procure agora</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-md-3 col-6 sm-mb-30px wow fadeInUp">
                            <a href="{{route('doctor')}}" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px opacity-7">
                                        <img src="assets/img/icon/categorie-1.png" alt="">
                                    </div>
                                    Medicos
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.2s">
                            <a href="{{route('clinic')}}" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px opacity-7">
                                        <img src="assets/img/icon/categorie-2.png" alt="">
                                    </div>
                                    Clinicas
                                </div>
                            </a>
                        </div>
                        {{--<div class="col-md-3 col-6 wow fadeInUp" data-wow-delay="0.4s">
                            <a href="#" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px">
                                        <img src="assets/img/icon/categorie-3.png" alt="">
                                    </div>
                                    Especialidades
                                </div>
                            </a>
                        </div>
                       <div class="col-md-3 col-6 wow fadeInUp" data-wow-delay="0.6s">
                            <a href="#" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px opacity-7">
                                        <img src="assets/img/icon/categorie-4.png" alt="">
                                    </div>
                                    Pharmacies
                                </div>
                            </a>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="padding-tb-100px">
        <div class="container">

            <div class="row">

                <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp">
                    <div class="service text-center opacity-hover-7 hvr-bob">
                        <div class="icon margin-bottom-10px">
                            <img src="assets/img/icon/service-1.png" alt="">
                        </div>
                        <h3 class="text-second-color">Facil acesso</h3>
                        <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service text-center opacity-hover-7 hvr-bob">
                        <div class="icon margin-bottom-10px">
                            <img src="assets/img/icon/service-2.png" alt="">
                        </div>
                        <h3 class="text-second-color">Maior Credibilidade</h3>
                        <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.4s">
                    <div class="service text-center opacity-hover-7 hvr-bob">
                        <div class="icon margin-bottom-10px">
                            <img src="assets/img/icon/service-3.png" alt="">
                        </div>
                        <h3 class="text-second-color">Pesquisa rapida</h3>
                        <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.6s">
                    <div class="service text-center opacity-hover-7 hvr-bob">
                        <div class="icon margin-bottom-10px">
                            <img src="assets/img/icon/service-4.png" alt="">
                        </div>
                        <h3 class="text-second-color">Qualidade de servico</h3>
                        <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    {{--<section class="padding-tb-100px background-grey-1">
        <div class="container">
            <!-- Title -->
            <div class="row justify-content-center margin-bottom-45px">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-md-10 wow fadeInUp">
                            <h1 class="text-second-color font-weight-300 text-sm-center text-lg-left margin-tb-15px">Medicos Destacados</h1>
                        </div>

                        <div class="col-md-2 wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{route('doctor')}}" class="text-main-color margin-tb-15px d-inline-block"><span class="d-block float-left margin-right-10px margin-top-5px">Mais medicos</span> <i class="far fa-arrow-alt-circle-right text-large margin-top-7px"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Title -->

            <div class="row">

                <!-- Doctor -->
                <div class="col-lg-3 col-md-6 hvr-bob sm-mb-45px">
                    <div class="background-white box-shadow wow fadeInUp" data-wow-delay="0.2s">
                        <div class="thum">
                            <a href="#"><img src="assets/img/medico4.jpg" alt=""></a>
                        </div>
                        <div class="padding-lr-30px padding-t-30px">

                            <h5 class="margin-tb-15px"><a class="text-dark" href="#">Dr. Shahrzat Moh</a></h5>

                        </div>
                        <div class="padding-lr-30px padding-tb-15px background-light-grey">
                            <div class="row no-gutters">
                                <div class="col-12"><a href="#" class="text-lime"><i class="far fa-bookmark"></i> Agendar consulta</a></div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Doctor -->

                <!-- Doctor -->
                <div class="col-lg-3 col-md-6 hvr-bob sm-mb-45px">
                    <div class="background-white box-shadow wow fadeInUp" data-wow-delay="0.2s">
                        <div class="thum">
                            <a href="#"><img src="assets/img/medico4.jpg" alt=""></a>
                        </div>
                        <div class="padding-lr-30px padding-t-30px">

                            <h5 class="margin-tb-15px"><a class="text-dark" href="#">Dr. Shahrzat Moh</a></h5>

                        </div>
                        <div class="padding-lr-30px padding-tb-15px background-light-grey">
                            <div class="row no-gutters">
                                <div class="col-12"><a href="#" class="text-lime"><i class="far fa-bookmark"></i> Agendar consulta</a></div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Doctor -->

                <!-- Doctor -->
                <div class="col-lg-3 col-md-6 hvr-bob sm-mb-45px">
                    <div class="background-white box-shadow wow fadeInUp" data-wow-delay="0.2s">
                        <div class="thum">
                            <a href="#"><img src="assets/img/medico4.jpg" alt=""></a>
                        </div>
                        <div class="padding-lr-30px padding-t-30px">

                            <h5 class="margin-tb-15px"><a class="text-dark" href="#">Dr. Shahrzat Moh</a></h5>

                        </div>
                        <div class="padding-lr-30px padding-tb-15px background-light-grey">
                            <div class="row no-gutters">
                                <div class="col-12"><a href="#" class="text-lime"><i class="far fa-bookmark"></i> Agendar consulta</a></div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Doctor -->

                <!-- Doctor -->
                <div class="col-lg-3 col-md-6 hvr-bob sm-mb-45px">
                    <div class="background-white box-shadow wow fadeInUp" data-wow-delay="0.2s">
                        <div class="thum">
                            <a href="#"><img src="assets/img/medico4.jpg" alt=""></a>
                        </div>
                        <div class="padding-lr-30px padding-t-30px">

                            <h5 class="margin-tb-15px"><a class="text-dark" href="#">Dr. Shahrzat Moh</a></h5>

                        </div>
                        <div class="padding-lr-30px padding-tb-15px background-light-grey">
                            <div class="row no-gutters">
                                <div class="col-12"><a href="#" class="text-lime"><i class="far fa-bookmark"></i> Agendar consulta</a></div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Doctor -->

            </div>
        </div>
    </section>--}}



     {{--<section class="padding-tb-100px">
        <div class="container">
            <!-- Title -->
            <div class="row justify-content-center margin-bottom-45px">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-md-10 wow fadeInUp">
                            <h1 class="text-second-color font-weight-300 text-sm-center text-lg-left margin-tb-15px">Clinicas destacadas</h1>
                        </div>

                        <div class="col-md-2 wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{route('clinic')}}" class="text-main-color margin-tb-15px d-inline-block"><span class="d-block float-left margin-right-10px margin-top-5px">Mais Clinicas</span> <i class="far fa-arrow-alt-circle-right text-large margin-top-7px"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // Title -->


           <div class="row">

                <!-- clinic -->
                <div class="col-lg-4 col-md-6 sm-mb-45px">
                    <div class="background-white full-width thum-hover box-shadow hvr-float wow fadeInUp" data-wow-delay="0.2s">
                        <div class="item-thumbnail thum background-white">
                            <a href="#"><img src="assets/img/clinica.jpg" alt=""></a>
                        </div>
                        <div class="padding-30px">
                            <h5 class="margin-bottom-20px"><a class="text-dark" href="#">Alrayan Eye Clinic</a></h5>
                            <div class="rating clearfix">
                                <span class="float-left text-grey-2"><i class="far fa-map"></i>  Maputo</span>

                            </div>
                        </div>
                        <div class="padding-lr-30px padding-tb-15px background-light-grey">
                            <div class="row no-gutters">
                                <div class="col-6"><a href="#" class="text-lime"><i class="far fa-bookmark"></i> Marcar consulta</a></div>

                                <div class="col-6 text-right"><a href="#" class="text-blue"><i class="far fa-hospital"></i> Hospital</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // clinic -->


                <!-- clinic -->
                <div class="col-lg-4 col-md-6 sm-mb-45px">
                    <div class="background-white full-width thum-hover box-shadow hvr-float wow fadeInUp" data-wow-delay="0.2s">
                        <div class="item-thumbnail thum background-white">
                            <a href="#"><img src="assets/img/clinica.jpg" alt=""></a>
                        </div>
                        <div class="padding-30px">
                            <h5 class="margin-bottom-20px"><a class="text-dark" href="#">Alrayan Eye Clinic</a></h5>
                            <div class="rating clearfix">
                                <span class="float-left text-grey-2"><i class="far fa-map"></i>  Maputo</span>

                            </div>
                        </div>
                        <div class="padding-lr-30px padding-tb-15px background-light-grey">
                            <div class="row no-gutters">
                                <div class="col-6"><a href="#" class="text-lime"><i class="far fa-bookmark"></i> Marcar consulta</a></div>

                                <div class="col-6 text-right"><a href="#" class="text-blue"><i class="far fa-hospital"></i> Hospital</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // clinic -->


                <!-- clinic -->
                <div class="col-lg-4 col-md-6 sm-mb-45px">
                    <div class="background-white full-width thum-hover box-shadow hvr-float wow fadeInUp" data-wow-delay="0.2s">
                        <div class="item-thumbnail thum background-white">
                            <a href="#"><img src="assets/img/clinica.jpg" alt=""></a>
                        </div>
                        <div class="padding-30px">
                            <h5 class="margin-bottom-20px"><a class="text-dark" href="#">Alrayan Eye Clinic</a></h5>
                            <div class="rating clearfix">
                                <span class="float-left text-grey-2"><i class="far fa-map"></i>  Maputo</span>

                            </div>
                        </div>
                        <div class="padding-lr-30px padding-tb-15px background-light-grey">
                            <div class="row no-gutters">
                                <div class="col-6"><a href="#" class="text-lime"><i class="far fa-bookmark"></i> Marcar consulta</a></div>

                                <div class="col-6 text-right"><a href="#" class="text-blue"><i class="far fa-hospital"></i> Hospital</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // clinic -->

            </div>

        </div>
    </section>--}}

   <script>
        $("#submit").click(function (e) {
            var searchInput = $("#searchInput").val();
            var searchSelect = $("#searchSelect").val();
            if (searchSelect == 1 && searchInput !== '') {
                document.form_index.action = "{{route('clinic')}}";
            }
            if (searchSelect == 2 && searchInput !== '') {
                document.form_index.action = "{{route('doctor')}}";
            }
            if (searchSelect == 3 && searchInput !== '') {
                document.form_index.action = "{{route('clinic')}}";
            }

            var select = document.querySelector('select');
            var option = select.children[select.selectedIndex];
            var SelectText = option.textContent;
            var Selectsearch = option.value;

            if (Selectsearch == 0) {
                e.preventDefault();
                document.getElementById('erroSelect').innerHTML = 'Selecione o que deseja pesquisar';
            }

            if (searchInput == '') {
                e.preventDefault();
                document.getElementById('erroInput').innerHTML = 'insere a pesquisa';
            }


        });
    </script>

@endsection
