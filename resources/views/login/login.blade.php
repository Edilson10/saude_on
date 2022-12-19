@extends('layout')

@section('title', 'Saude ON')

@section('content')

    <div id="page-title" class="padding-pages gradient-white">
        <div class="container text-center">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li class="active">Login</li>
            </ol>
            <h1 class="font-weight-300">Página de login</h1>
        </div>

    </div>

    <div class="container margin-bottom-100px">
        <!--======= log_in_page =======-->

            {{-- Erros de validacoes --}}
         {{-- @if($errors->any())
              @foreach($errors->all() as $message)
              <p class="alert alert-danger text-center">{{$message}}</p>
              @endforeach
          @endif--}}

          {{-- Erros de login --}}
            @if(isset($erro))
                <p class="alert alert-danger text-center">{{$erro}}</p>
            @endif


        <div id="log-in" class="site-form log-in-form box-shadow border-radius-10">

            <div class="form-output">
                <form method="post" action="{{route('login_submit')}}">
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


                    <p>você tem uma conta? <a href="{{route('sign')}}">Registrar agora</a> </p>
                </form>
            </div>
        </div>
        <!--======= // log_in_page =======-->

    </div>



@endsection
