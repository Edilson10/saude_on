<!DOCTYPE html>
<html lang="en-US">

<head>
	<title>@yield('title')</title>
	<meta name="author" content="Nile-Theme">
	<meta name="robots" content="index follow">
	<meta name="googlebot" content="index follow">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="keywords" content="directory, doctor, doctor directory, Health directory, listing, map, medical, medical directory, professional directory, reservation, reviews">
	<meta name="description" content="Health Care & Medical Services Directory">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- google fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800%7CPoppins:300i,300,400,700,400i,500%7CDancing+Script:700%7CDancing+Script:700" rel="stylesheet">
	<!-- animate -->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/animate.css')}} "/>
	<!-- owl Carousel assets -->
	<link href="{{URL::asset('assets/css/owl.carousel.cs')}}" rel="stylesheet">
	<link href="{{URL::asset('assets/css/owl.theme.css')}}" rel="stylesheet">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
	<!-- hover anmation -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/hover-min.css')}}">
	<!-- flag icon -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/flag-icon.min.css')}}">
	<!-- main style -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
	<!-- colors -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/colors/main.css')}}">
	<!-- elegant icon -->
	<link rel="stylesheet" href="{{URL::asset('assets/css/elegant_icon.css')}}">
    <!-- Nosso estilo -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/estilo.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- jquery library  -->
	<script src="{{URL::asset('assets/js/jquery-3.2.1.min.js')}}"></script>

	<!-- Maps library  -->
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="{{URL::asset('assets/js/jquery.gomap-1.3.3.min.js')}}"></script>

	<!-- fontawesome  -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script  src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <script src="'https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js'"></script>


</head>

<body>
    <header class="background-white box-shadow fixed-header">
		<div class="container-fluid header-in">


			<div class="row">
				<div class="col-lg-2 col-md-12">
					<a id="logo" href="{{route('home')}}" class="d-inline-block margin-tb-15px"><h1 class="logo">Saude ON</h1></a>
					<a class="mobile-toggle padding-13px background-main-color" href="#"><i class="fas fa-bars"></i></a>
				</div>
				<div class="col-lg-7 col-md-12 position-inherit">
						<ul id="menu-main" class="nav-menu float-lg-right link-padding-tb-20px">
						<li><a href="{{route('doctor')}}">Medicos</a></li>
						<li><a href="{{route('clinic')}}">Clinicas</a></li>
						<li><a href="page-contact-us.html">Contacte-nos</a></li>
					 </ul>
				</div>
				<div class="col-lg-3 col-md-12">
					<hr class="margin-bottom-0px d-block d-sm-none">
                    @if (session()->has('usuario'))
                    <hr class="margin-bottom-0px d-block d-sm-none">
					<a href="{{route('show_appointment')}}" class="btn btn-sm border-radius-30 margin-tb-15px text-white background-second-color  box-shadow float-right padding-lr-20px margin-left-30px">
                          <i class="fas fa-plus-circle"></i>  Consultas
                        </a>

                           <ul id="menu-main" class="nav-menu float-lg-right link-padding-tb-20px">
                            <li class="has-dropdown"><p class="margin-tb-20px  d-inline-block text-up-small float-left float-lg-right"><i class="far fa-user"></i> {{session('usuario')['nome']}}</p>
                                <ul class="sub-menu">
                                    <li><a href="{{route('show_profile')}}"><i class="far fa-user"></i> Perfil</a></li>
                                    <li><a href="{{route('logout')}}"><i class="fa fa-fw fa-sign-out-alt"></i>Sair</a></li>
                                </ul>
                            </li>
                           </ul>
                        @else
                          <a href="{{route('login')}}" class="margin-tb-20px d-inline-block text-up-small float-right padding-lr-30px margin-left-30px"><i class="far fa-user"></i>  Entrar</a>
                        @endif
                </div>
			</div>

		</div>
	</header>
	<!-- // Header  -->


