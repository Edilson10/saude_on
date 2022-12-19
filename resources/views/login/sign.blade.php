@extends('layout')

@section('title', 'Saude ON')

@section('content')

<div id="page-title" class="padding-pages gradient-white">
        <div class="container text-center">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li class="active">Sing Up</li>
            </ol>
            <h1 class="font-weight-300">Registro do usuario</h1>
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
        <div id="log-in" class="site-form log-in-form box-shadow border-radius-10">

            <div class="form-output">

                <form method="post" action="{{route('register')}}">
                    @csrf
                    <div class="form-group label-floating">
                        <label class="control-label">Nome completo</label>
                        <input class="form-control @error('nome') is-invalid @enderror" name="nome" placeholder="" type="text" value="{{old('nome')}}">

                        @error('nome')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" name="email" placeholder="" type="email" value="{{old('email')}}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Celular</label>
                        <input class="form-control @error('celular') is-invalid @enderror" name="celular" placeholder="" type="number" value="{{old('celular')}}">

                        @error('celular')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group label-floating is-select">
                        <label class="control-label">Provincia</label>
                        <select name="provincia" class="selectpicker form-control @error('provincia') is-invalid @enderror" value="{{old('provincia')}}" required>
                            <option value="0">-----------Selecione a provincia---------------</option>
                            @if (isset($provinces) && count($provinces) > 0)
                                @foreach ($provinces as $province)
                                    <option value="{{$province->id_provincia}}">{{$province->nome}}</option>
                                @endforeach
                            @endif
                        </select>

                        @error('provincia')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Senha</label>
                        <input class="form-control @error('senha') is-invalid @enderror" name="senha" placeholder="" type="password" value="{{old('senha')}}">

                        @error('senha')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Confirme Sua Senha</label>
                        <input class="form-control @error('senha_confirmation') is-invalid @enderror" name="senha_confirmation" placeholder="" type="password" value="{{old('confirme')}}">

                        @error('senha_confirmation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    {{-- <div class="remember">
                        <div class="checkbox">
                            <label>
							<input name="optionsCheckboxes" type="checkbox">
							Aceito Os  <a href="#">Termos E Condicoes</a> Do Site
						</label>
                        </div>
                    </div> --}}

                    <button class="btn btn-md btn-primary full-width">Registrar !</button>

                    <div class="or"></div>

                    {{--<a href="#" class="btn btn-md bg-facebook full-width btn-icon-left"><i class="fab fa-facebook margin-right-8px" aria-hidden="true"></i> Login with Facebook</a>

                    <a href="#" class="btn btn-md bg-twitter full-width btn-icon-left"><i class="fab fa-twitter margin-right-8px" aria-hidden="true"></i> Login with Twitter</a>--}}


                    <p>você tem uma conta?  <a href="{{route('login')}}"> Entrar!</a> </p>
                </form>

            </div>
        </div>
        <!--======= // log_in_page =======-->

    </div>

@endsection
