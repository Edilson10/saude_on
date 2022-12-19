@extends('layout')

@section('title', 'Saude ON')

@section('content')

<div class="container-fluid overflow-hidden">
    <div class="row margin-tb-90px margin-lr-100px sm-mrl-0px">
        @include('menu_profile')
        <div class="row margin-tb-45px full-width">
            <div class="col-md-4">
                <div class="padding-15px background-white">
                    <a href="#" class="d-block margin-bottom-10px"><img src="http://placehold.it/500x500" alt=""></a>
                    <a href="#" class="btn btn-sm  text-white background-main-color btn-block">Upload Image</a>
                </div>
            </div>
            <div class="col-md-8">

                <form method="post" action="{{route('update_user')}}">
                    @csrf

                    <div class="row">
                        @if (isset($users) && count($users) > 0)
                                @foreach ($users as $userValue)
                                <input type="hidden" name="id_usuario" value="{{$userValue->id_usuario}}">
                                    <div class="col-md-6 margin-bottom-20px">
                                        <label><i class="far fa-user margin-right-10px"></i> Nome completo</label>
                                        <input type="text" name="nome" class="form-control form-control-sm  @error('nome') is-invalid @enderror" value="{{$userValue->nome}}">
                                        @error('nome')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 margin-bottom-20px">
                                        <label><i class="fas fa-lock margin-right-10px"></i> Provincia</label>
                                        <select name="provincia" class="form-control form-control-sm @error('provincia') is-invalid @enderror">
                                            <option value="{{$userValue->id_provincia}}">{{$userValue->nome_pr}}</option>
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
                                    <div class="col-md-6 margin-bottom-20px">
                                        <label><i class="far fa-envelope-open margin-right-10px"></i> E-mail</label>
                                        <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{$userValue->email}}">

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{$message }}
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 margin-bottom-20px">
                                        <label><i class="fas fa-mobile-alt margin-right-10px"></i> Celular</label>
                                        <input type="number" name="celular" class="form-control form-control-sm @error('celular') is-invalid @enderror" value="{{$userValue->celular}}">
                                        @error('celular')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                @endforeach
                        @endif

                    </div>

                    <button type="submit" class="btn btn-md padding-lr-25px  text-white background-main-color btn-inline-block">Atualizar</button>
            </form>

            <hr class="margin-tb-40px">

            <form method="post" action="{{route('update_password')}}">
                @csrf
                    <div class="row">
                        <div class="col-md-6 margin-bottom-20px">
                            <label><i class="fas fa-lock margin-right-10px"></i> Senha Actual</label>
                            <input type="password" name="old_password" class="form-control form-control-sm @error('old_password') is-invalid @enderror" value="{{old('old_password')}}">
                            @error('old_password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-6 margin-bottom-20px">
                            <label><i class="fas fa-lock margin-right-10px"></i> Confirmar Senha</label>
                            <input type="password" name="confirm_password"  class="form-control form-control-sm @error('confirm_password') is-invalid @enderror" value="">
                            @error('confirm_password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-6 margin-bottom-20px">
                            <label><i class="fas fa-lock margin-right-10px"></i> Nova Senha</label>
                            <input type="password" name="new_password"  class="form-control form-control-sm @error('new_password') is-invalid @enderror" value="{{old('new_password')}}">
                            @error('new_password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        </div>

                    </div>
                    <button type="submit" class="btn btn-md padding-lr-25px  text-white background-main-color btn-inline-block">Alterar</button>
            </form>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid-->
<!-- /.content-wrapper-->
@endsection
