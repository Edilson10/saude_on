@extends('admin.layout_admin')

@section('title', 'Saude ON')

@section('content')
<div class="col-md-12" id="doctor">
    <!-- Page Title -->
    <div id="page-title" class="padding-30px background-white full-width">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li class="active">Medicos</li>
            </ol>
            <h1 class="font-weight-300">Associar Medicos</h1>
        </div>
    </div>
    <!-- // Page Title -->

     <!--   Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selecione as especialidades do medico que pretende!!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
                </div>
                <form method="Post" @submit.prevent="assoctionDoctor();">
                    @csrf
                    <div class="modal-body">

                            <table id='example1' class='table table-bordered table-hover'>

                                <tr v-for="specialty in specialtys" :key="specialty.id_especialidade">

                                    <td>
                                        <input type="checkbox" name="id_especialidade[]"  id="specialty" v-bind:value="specialty.id_especialidade" v-model="id_especialidade">
                                        <label  for="specialty">@{{specialty.nome}}</label>

                                    </td>

                                </tr>

                                <input type="text" name="id_medico"  v-model="id.id_medico">
                                <input type="text" v-model="id_especialidade">
                            </table>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button"  data-dismiss="modal">Cancel</button>
                        <button  type="submit" class="btn btn-primary">Associar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="margin-tb-45px full-width">
        <div class="padding-30px background-white border-radius-20 box-shadow">
            <div class="row">
                <div class="form-group has-search col-md-3 margin-bottom-20px ">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Pesquisar medico" v-model="search">
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Celular</th>

                    <th scope="col" style="width: 200px;">Accoes</th>
                </tr>
                </thead>
                <tbody>

                <tr v-for="medico in medicos" :key="medico.id_usuario">
                    <input type="text" name="id_doctor"  v-model="id.id_medico">
                    <td>@{{medico.id_usuario}}</td>
                    <td>@{{medico.nome}}</td>
                    <td>@{{medico.email}}</td>
                    <td>@{{medico.celular}}</td>

                    <td>
                        <button v-on:click="inserir=true; specialty(medico.id_usuario); abrirModal();"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-check-circle"></i></button>

                    </td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>

</div>


<script>

let root = new Vue({
    el: "#doctor",
    data() {
        return {
            titulomodal:'',
            medicos:[],
            search:'',
            specialtys:[],
            id_especialidade:[],
            id_spec_clinic:[],
            id:{
                id_medico:''
            }

        }

    },

    methods:{
        searchData (val){
            axios.get('/admin/medicos/associar/pesquisa/'+val).then((res)=>{
                this.medicos = res.data;
            })
        },
        specialty (id){
            axios.get('/admin/medicos/associar/especialidades/'+id).then((res)=>{
                this.specialtys = res.data.results;
                this.id_spec_clinic = res.data.clinicIdSpecialty;
            })
            this.id.id_medico = id;
        },

        assoctionDoctor() {
            axios.post('/admin/medicos/associar', {id_medico: this.id.id_medico, id_especialidade: this.id_especialidade}).then((res)=>{
                if (res.data.error == true) {
                    toastr.error('Ja existe o medico')
                }else{
                    toastr.success('Medico associado com sucesso')
                    window.location = res.data.redirect;
                }
            })

        }
    },

    watch:{
        search (){
            console.log(this.search)
            this.searchData(this.search);
        }
    }
});

</script>

<style scoped>
.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 1rem;
    height: 2.375rem;
    margin-left: 1rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}

.mostrar{
    display: list-item;
    opacity: 1;
    background: rgba(44, 38, 75, 0.849);
}
</style>

@endsection

