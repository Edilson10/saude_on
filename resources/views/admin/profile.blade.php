@extends('admin.layout_admin')

@section('title', 'Saude ON')

@section('content')
<div id="profile">
        <!-- Page Title -->
    <div id="page-title" class="padding-30px background-white full-width">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li class="active">Meu Perfil</li>
            </ol>
            <h1 class="font-weight-300">Meu Perfil</h1>
        </div>
    </div>
    <!-- // Page Title -->

    <div class="row margin-tb-45px full-width">
        <div class="col-md-4">
            <div class="padding-15px background-white">
                <a href="#" class="d-block margin-bottom-10px"><img src="http://placehold.it/500x500" alt=""></a>
                <a href="#" class="btn btn-sm  text-white background-main-color btn-block">Upload Image</a>
            </div>
        </div>
        <div class="col-md-8">
            <form method="post" enctype="multipart/form-data" @submit.prevent="update();">

                <div class="row">

                    <input type="hidden" v-model="form.id_usuario">
                    <div class="col-md-6 margin-bottom-20px">
                        <label><i class="far fa-user margin-right-10px"></i> Nome completo</label>
                        <input type="text"  class="form-control form-control-sm" v-model="form.nome">
                        <div class="text-danger" v-if="errors.nome" v-text="errors.nome[0]"></div>
                    </div>
                    <div class="col-md-6 margin-bottom-20px">
                        <label><i class="fas fa-lock margin-right-10px"></i> Provincia</label>
                        <select  class="form-control form-control-sm" v-model="form.id_provincia">
                            <option v-bind:value="form.id_provincia" disabled>@{{form.provincia}}</option>
                            <option v-for="province in provinces" v-bind:value="province.id_provincia">@{{province.nome}}</option>
                        </select>
                        <div class="text-danger" v-if="errors.provincia" v-text="errors.provincia[0]"></div>
                    </div>
                    <div class="col-md-6 margin-bottom-20px">
                        <label><i class="far fa-envelope-open margin-right-10px"></i> E-mail</label>
                        <input type="text" class="form-control form-control-sm" v-model="form.email">
                        <div class="text-danger" v-if="errors.email" v-text="errors.email[0]"></div>

                    </div>
                    <div class="col-md-6 margin-bottom-20px">
                        <label><i class="fas fa-mobile-alt margin-right-10px"></i> Celular</label>
                        <input type="text" class="form-control form-control-sm" v-model="form.celular">
                        <div class="text-danger" v-if="errors.celular" v-text="errors.celular[0]"></div>
                    </div>
                    <div class="col-md-6 margin-bottom-20px">
                        <button  type="submit" class="btn btn-md padding-lr-25px  text-white background-main-color btn-inline-block">Atualizar</button>
                    </div>

                </div>

            </form>

            <hr class="margin-tb-40px">

            <form @submit.prevent="updatePassword();">
                <div class="row">
                    <div class="col-md-6 margin-bottom-20px">
                        <label><i class="fab fa-facebook margin-right-10px"></i> Senha Actual</label>
                        <input type="password" class="form-control form-control-sm" v-model="password.old_password">
                        <div class="text-danger" v-if="errors.old_password" v-text="errors.old_password[0]"></div>
                    </div>
                    <div class="col-md-6 margin-bottom-20px">
                        <label><i class="fab fa-twitter margin-right-10px"></i> Confirmar Senha</label>
                        <input type="password" class="form-control form-control-sm" v-model="password.confirm_password">
                        <div class="text-danger" v-if="errors.confirm_password" v-text="errors.confirm_password[0]"></div>

                    </div>
                    <div class="col-md-6 margin-bottom-20px">
                        <label><i class="fab fa-youtube margin-right-10px"></i> Nova senha</label>
                        <input type="password" class="form-control form-control-sm" v-model="password.new_password">
                        <div class="text-danger" v-if="errors.new_password" v-text="errors.new_password[0]"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-md padding-lr-25px  text-white background-main-color btn-inline-block">Update Profile</button>
            </form>


        </div>
    </div>
</div>

<script>
    let root = new Vue({
        el:'#profile',
        data() {
            return {
                errors:[],
                provinces:[],
                form:{
                    id_usuario:'',
                    nome:'',
                    celular:'',
                    email:'',
                    provincia:'',
                    id_provincia:''
                },
                password:{
                    old_password:'',
                    new_password:'',
                    confirm_password:''
                }

            }
        },

        methods:{
            getValueClinic() {
                axios.get('/admin/perfil/dados').then((res)=>{
                    let myArray = res.data.profileData;
                    myArray.forEach((value, index) => {
                        this.form.id_usuario = value.id_usuario;
                        this.form.nome = value.nome;
                        this.form.email = value.email;
                        this.form.celular = value.celular;
                        this.form.provincia = value.nome_pr;
                        this.form.id_provincia = value.id_provincia;

                    });
                    this.provinces = res.data.province;
                })
            },

            update() {
                axios.post('/admin/perfil/atualizar', this.form).then( response => {

                    toastr.success('Dados atualizados com sucesso');
                    this.errors = {}
                }).catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },

            updatePassword() {

                axios.post('/admin/perfil/atualizar_senha', {old_password: this.password.old_password, new_password: this.password.new_password, confirm_password: this.password.confirm_password}).then( response => {

                    toastr.success('Senha alterada com sucesso');
                      this.errors = {}
                      this.password = ''
                }).catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors.message;
                    }
                });

            }

        },


        created() {
            this.getValueClinic();
        }


    });
</script>

@endsection

