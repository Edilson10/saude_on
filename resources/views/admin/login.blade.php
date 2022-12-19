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
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}} "/>
	<!-- owl Carousel assets -->
	<link href="{{asset('assets/css/owl.carousel.cs')}}" rel="stylesheet">
	<link href="{{asset('assets/css/owl.theme.css')}}" rel="stylesheet">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<!-- hover anmation -->
	<link rel="stylesheet" href="{{asset('assets/css/hover-min.css')}}">
	<!-- flag icon -->
	<link rel="stylesheet" href="{{asset('assets/css/flag-icon.min.css')}}">
	<!-- main style -->
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<!-- colors -->
	<link rel="stylesheet" href="{{asset('assets/css/colors/main.css')}}">
	<!-- elegant icon -->
	<link rel="stylesheet" href="{{asset('assets/css/elegant_icon.css')}}">
    <!-- Nosso estilo -->
    <link rel="stylesheet" href="{{asset('assets/css/estilo.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- jquery library  -->
	<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>

	<!-- Maps library  -->
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="{{asset('assets/js/jquery.gomap-1.3.3.min.js')}}"></script>

	<!-- fontawesome  -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script  src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <script src="'https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js'"></script>


</head>

<body>

    <div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-center">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Admin</a></li>
                <li class="active">Login</li>
            </ol>
            <h1 class="font-weight-300">Login Admin</h1>
        </div>
    </div>

    <div class="container margin-bottom-100px">
        <!--======= log_in_page =======-->
          {{-- Erros de login --}}
           @if(isset($erro))
                <p class="alert alert-danger text-center">{{$erro}}</p>
            @endif

        <div id="log-in" class="site-form log-in-form box-shadow border-radius-10">

            <div class="form-output">
                <form method="post" action="{{route('admin_loginSubmit')}}">
                    @csrf
                    <div class="form-group label-floating">
                        <label class="control-label">Usuario</label>
                        <input class="form-control @error('usuario') is-invalid @enderror" name="usuario" placeholder="" type="text" value="{{old('email')}}">
                        @error('usuario')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Sua Senha</label>
                        <input class="form-control @error('senha') is-invalid @enderror" name="senha" placeholder="" type="password">
                        @error('senha')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                    </div>

                    <div class="remember">
                        <div class="checkbox">
                            <label>
							<input name="optionsCheckboxes" type="checkbox">
								Lembre De Me
						</label>
                        </div>
                        <a href="#" class="forgot">Esqueci minha senha</a>
                    </div>

                    <button class="btn btn-md btn-primary full-width">Entrar</button>

                    <div class="or"></div>

                   {{-- <a href="#" class="btn btn-md bg-facebook full-width btn-icon-left"><i class="fab fa-facebook margin-right-8px" aria-hidden="true"></i> Login with Facebook</a>

                    <a href="#" class="btn btn-md bg-twitter full-width btn-icon-left"><i class="fab fa-twitter margin-right-8px" aria-hidden="true"></i> Login with Twitter</a>--}}
                </form>
            </div>
        </div>
        <!--======= // log_in_page =======-->

    </div>

    <script  src="{{asset('assets/js/sticky-sidebar.js')}}"></script>
    <script  src="{{asset('assets/js/YouTubePopUp.jquery.js')}}"></script>
    <script  src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script  src="{{asset('assets/js/imagesloaded.min.js')}}"></script>
    <script  src="{{asset('assets/js/wow.min.js')}}"></script>
    <script  src="{{asset('assets/js/custom.js')}}"></script>
    <script  src="{{asset('assets/js/popper.min.js')}}"></script>
    <script  src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script  src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
    <script  src="{{asset('assets/js/somait.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
